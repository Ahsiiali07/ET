<?php

namespace App\Services;

use App\Models\Support;
use App\Models\User;

/**
 * Class EmailNotificationService
 *
 * @package App\Services
 */
interface IEmailNotificationServiceInterface {

    /** @var string ForgetPasswordMail */
    const ForgetPasswordMail = 'ForgetPassword';

    /** @var string SupportMail */
    const SupportMail = 'Support';

    /** @var string SignupMail */
    const SignupMail = 'Signup';

    /** @var string AwaitingApprovalMail */
    const AwaitingApprovalMail = 'AwaitingApproval';

    /** @var string SignupMail */
    const NewOtpMail = 'NewOtp';


    /**
     * @param User $user
     *
     * @return mixed
     */
    public function forgetPasswordEmail( User $user );

    /**
     * @param Support $request
     *
     * @return mixed
     */
    public function supportEmail( Support $request );

    /**
     * @param User $user
     */
    public function signupEmail( User $user );

    /**
     * @param $user
     */
    public function newOtp( $user );

}
