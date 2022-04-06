<?php

namespace App\Mail;

use App;
use App\Mail\BaseMail;

/**
 * Class ForgetPassword
 * @package App\Mail
 */
class ForgetPassword extends BaseMail {
    private $_data;

    /**
     * UpdateUser constructor.
     *
     * @param $data
     */
    public function __construct( $data ) {
        $this->_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $user = $this->_data['user'];

        // Set the subject of the mail.
        $this->subject = trans('user.Reset Password');
        $this->to( $user );

        return $this->view( 'mails.client_forget_password_email' )->with(
            array(
                'title' => $this->subject,
                'user'  => $user,
            )
        );
    }
}
