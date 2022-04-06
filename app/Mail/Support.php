<?php

namespace App\Mail;

use App;
use App\Mail\BaseMail;

/**
 * Class Support
 * @package App\Mail
 */
class Support extends BaseMail {
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
        $request = $this->_data['request'];

        // Set the subject of the mail.
        $this->subject = trans('user.Support Request');

        return $this->view( 'mails.admin_support_email' )->with(
            array(
                'title'   => $this->subject,
                'request' => $request,
            )
        );
    }
}
