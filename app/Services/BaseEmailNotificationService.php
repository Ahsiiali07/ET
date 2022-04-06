<?php


namespace App\Services;

use App\Services\Users\IUserType;
use App\Services\Users\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

/**
 * Class BaseEmailNotificationService
 * @package App\Services
 */
class BaseEmailNotificationService {

    /**
     * @param $emails
     * @param $class
     * @param $data
     */
    public function mailTo( $emails, $class, $data ) {
        $className = sprintf( 'App\Mail\%s', $class );
        if ( class_exists( $className ) ) {
            Mail::to( $emails )->send( new $className( $data ) );
        }
    }

    /**
     * @param $data
     * @param $class
     */
    public function userEmails( $data, $class ) {
        $user = $data['user'];
        $user      = App::make( UserService::class )->findById( $user['id'] );
        $userEmail = $user->email;
        $this->mailTo( $userEmail, $class, $data );
    }

    /**
     * @param $data
     * @param $class
     */
    public function supportEmails( $data, $class ) {
        $request = $data['request'];
        $this->mailTo( env( "SUPPORT_EMAIL_ADDRESS" ), $class, $data );
    }
}
