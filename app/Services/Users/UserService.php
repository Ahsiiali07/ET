<?php

namespace App\Services\Users;

use App\Helpers\GeneralHelper;
use App\Models\User;
use App\Services\BaseService;
use App\Forms\IForm;
use App\Services\EmailNotificationService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use App;
use Carbon\Carbon;
use Auth;
use DB;
use Hash;
use EloquentBuilder;
use Illuminate\Http\Request;
use willvincent\Rateable\Rating;

/**
 * Class UserService
 * @package App\Services\Users
 */
class UserService extends BaseService implements IUserServiceInterface {


    /**
     * UserService constructor.
     */
    public function __construct() {
        /** @var User */
        $this->model = new User();

        parent::__construct();
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function findByEmail( $email ) {
        return $this->model->where( 'email', $email )->first();
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function findBySocialToken( $token ) {
        return $this->model->where( 'social_token', $token )->first();
    }

    /**
     * @param $pin
     *
     * @return mixed
     */
    public function findByPin( $pin ) {
        return $this->model->where( 'pin', $pin )->first();
    }

    /**
     *
     * @return mixed
     */
    public function findAllByFCM() {
        return $this->model->whereNotNull( 'device_token' )->get();
    }

    /**
     * @param $otp
     *
     * @return mixed
     */
    public function findByOTP( $otp ) {
        return $this->model->where( 'signup_otp', $otp )->first();
    }

    /**
     * @param  $id
     *
     * @return mixed|void
     */
    public function remove( $id ) {
        $user = $this->findById( $id );

        return $user->delete();
    }

//    /**
//     * @param  $id
//     *
//     * @return mixed|void
//     */
//    public function approve( $id ) {
//        $user              = $this->findById( $id );
//        $user->is_approved = true;
//
//        $res = $user->save();
//
//        /** @var EmailNotificationService $mailService */
//        $mailService = App::make( EmailNotificationService::class );
//        $mailService->signupEmail( $user );
//
//        return $res;
//    }

    /**
     * @param $form
     * @param $userId
     *
     * @return mixed
     */
    public function updateDetails( $form, $userId ) {
        $form->validate();
        $user            = $this->findById( $userId );
        $form->old_image = $user->image;
        if ( $form->image ) {
            $form->image = GeneralHelper::uploadImageManual( $form->image, 'images/user', ( ! $form->old_image ) ?: true, $form->old_image ?? null );
        } else {
            $form->image = $form->old_image;
        }
        $form->loadToModel( $user );
        $user->save();

        return $user;
    }

    /**
     * @return User[]|Collection
     */
    public function getAllVerified() {
        return $this->model->where( 'is_verified', 1 )->get();
    }

    /**
     * @param $form
     * @param $userId
     *
     * @return mixed
     */
    public function updateStatus( $form, $userId ) {
        $form->validate();
        $user = $this->findById( $userId );
        $form->loadToModel( $user );
        $user->status = $form->status;
        $user->save();

        return $user;
    }

    /**
     * @param $id
     *
     * @throws \Exception
     */
    public function activate( $id ) {
        $user = $this->model->withTrashed()->find( $id );
        DB::beginTransaction();
        $user->restore();
        $user->status = 1;
        $user->save();
        DB::commit();
    }


    /**
     * Get all super admins
     *
     * @return mixed
     */
    public function getSuperAdmins() {
        return $this->model
            ->where( 'user_type', IUserType::ADMIN )
            ->get();
    }

    /**
     * Get super admin emails
     *
     * @return mixed
     */
    public function getSuperAdminEmails() {
        return $this->getSuperAdmins()->pluck( 'email' )->toArray();
    }

    /**
     * @param $userType
     *
     * @return mixed
     */
    public function getByType( $userType ) {
        return $this->model
            ->where( 'user_type', $userType )
            ->get();
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function fetchByEmail( $email ) {
        return $this->model->where( 'email', $email )->first();
    }

    /**
     * @param $email
     * @param $password
     * @param $token
     *
     * @return Authenticatable|bool
     */
    public function login( $email, $password, $token ) {
        if (
            Auth::attempt(
                [
                    'email'    => $email,
                    'password' => $password
                ]
            )
        ) {
            /** @var User $user */
            $user = Auth::user();
            if ( $user ) {
                $user->device_token = $token;
                $user->save();

                if ( $user->is_verified && $user->status ) {
                    return $user;
                }

                if ( ! $user->status ) {

                    return 'is_blocked';
                }

                return 'is_not_verified';
            }
        }

        return 'wrong_credentials';
    }

    /**
     * @param $email
     *
     * @return bool
     */
    public function forgetPasswordRequest( $email ) {
        $user = $this->fetchByEmail( $email );
        if ( $user ) {
            $user->pin = $this->generateRandom( 10 );
            $user->save();
            /** @var EmailNotificationService $mailService */
            $mailService = App::make( EmailNotificationService::class );
            $mailService->forgetPasswordEmail( $user );

            return $user;
        }

        return false;
    }

    /**
     * @param $pin
     *
     * @return bool
     */
    public function pinMatch( $pin ) {
        $user = $this->findByPin( $pin );
        if ( $user ) {
            if ( $user['pin'] == $pin ) {
                $user->pin = null;
                $user->save();

                return $user;
            }

            return false;
        }

        return false;
    }

    /**
     * @param $otp
     *
     * @return false|mixed
     */
    public function otpMatch( $otp ) {
        $user = $this->findByOTP( $otp );
        if ( $user ) {
            if ( $user['signup_otp'] == $otp ) {
                $user->is_verified = true;
                $user->signup_otp  = null;
                $user->save();

                return $user;
            }

            return false;
        }

        return false;
    }

    /**
     * @param $userId
     * @param $password
     *
     * @return bool
     */
    public function changePassword( $userId, $password ) {
        $user = $this->findById( $userId );
        if ( $user ) {
            $user->password    = Hash::make( $password );
            $user->is_verified = true;
            $user->save();

            return $user;
        }

        return false;
    }

    /**
     * @param $email
     *
     * @return bool|Authenticatable|null
     */
    public function fingerPrint( $email ) {

        $user = $this->fetchByEmail( $email );

        if ( Auth::loginUsingId( $user->id ) ) {
            return Auth::user();
        }

        return false;
    }

    /**
     * @param $userId
     *
     * @return mixed
     */
    public function fetchToken( $userId ) {
        $user = $this->findById( $userId );

        return $user->createToken( 'eh' )->accessToken;
    }

    /**
     * @param IForm $form
     *
     * @return bool|mixed
     */
    public function register( IForm $form ) {
        $user = new User();
        $form->loadToModel( $user );
        $user->signup_otp  = $this->generateRandom( 5 );
        $user->is_verified = false;
        $user->password    = Hash::make( $form->password );
        $user->is_approved = true;
        $user->save();

        /** @var EmailNotificationService $mailService */
        $mailService = App::make( EmailNotificationService::class );
        $mailService->signupEmail( $user );

        return $user;
    }

    /**
     * @param $token
     * @param $data
     *
     * @return false|mixed
     */
    public function registerPassword( $token, $data ) {
        $user = $this->findByOTP( $token );
        if ( $user ) {
            if ( $user['signup_otp'] == $token ) {
                $user->password    = Hash::make( $data['password'] );
                $user->is_verified = true;
                $user->signup_otp  = null;
                $user->save();

                return $user;


            }

            return false;
        }

        return false;
    }

    /**
     * @param IForm $form
     *
     * @return User
     */
    public function socialRegister( IForm $form ) {
        $user = new User();
        $form->loadToModel( $user );
        $user->user_type   = IUserType::USER;
        $user->is_verified = true;
        if ( isset( $form->image ) ) {
            $user->image = GeneralHelper::uploadImageManual( $form->image, 'images/users' );
        }
        $user->save();

        return $user;
    }

    /**
     * @param $length
     *
     * @return false|string
     */
    private function generateRandom( $length ) {
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr( str_shuffle( $str ), 0, $length );
    }

    /**
     * @param $user_id
     *
     * @return mixed
     */
    public function generateNewOtp( $user_id ) {
        $user             = $this->findById( $user_id );
        $user->signup_otp = $this->generateRandom( 5 );
        $user->save();

        /** @var EmailNotificationService $mailService */
        $mailService = App::make( EmailNotificationService::class );
        $mailService->newOtp( $user );

        return $user;
    }

    /**
     * @param Request $data
     *
     * @return mixed
     */
    public function search( $data, $perpage = 20 ) {
        $query = $this->model;

        $query = EloquentBuilder::to( $query, $data );

        return $query->paginate( $perpage );
    }

    /**
     * @return mixed
     */
    public function searchUser()
    {
        return User::where('user_type', IUserType::USER)->get();
    }







}
