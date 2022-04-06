<?php

namespace App\Services;

use App\Models\Support;
use App\Models\User;

/**
 * Class EmailNotificationService
 * @package App\Services
 */
class EmailNotificationService extends BaseEmailNotificationService implements IEmailNotificationServiceInterface {

    /**
     * EmailNotificationService constructor.
     */
    public function __construct() {
        //
    }

    /**
     * @param User $user
     */
    public function forgetPasswordEmail( User $user )
    {
        $data = [
            'user' => $user
        ];
        $this->userEmails(
            $data,
            IEmailNotificationServiceInterface::ForgetPasswordMail
        );
    }

    /**
     * @param Support $request
     */
    public function supportEmail( Support $request )
    {
        $data = [
            'request' => $request
        ];
        $this->supportEmails(
            $data,
            IEmailNotificationServiceInterface::SupportMail
        );
    }

    /**
     * @param User $user
     */
    public function signupEmail( User $user ) {
        $data = [
            'user' => $user
        ];
        $this->userEmails(
            $data,
            IEmailNotificationServiceInterface::SignupMail
        );
    }

    /**
     * @param User $user
     */
    public function awaitingApprovalMail( User $user ) {
        $data = [
            'user' => $user
        ];
        $this->userEmails(
            $data,
            IEmailNotificationServiceInterface::AwaitingApprovalMail
        );
    }

    /**
     * @param $user
     */
	public function newOtp( $user ) {
        $data = [
            'user' => $user
        ];
        $this->userEmails(
            $data,
            IEmailNotificationServiceInterface::NewOtpMail
        );
	}
}
