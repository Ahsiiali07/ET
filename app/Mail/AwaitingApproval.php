<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class AwaitingApproval
 * @package App\Mail
 */
class AwaitingApproval extends Mailable {

    use Queueable, SerializesModels;

    /** @var  $data */
    public $data;

    /**
     * UserSignup constructor.
     *
     * @param $data
     */
    public function __construct( $data ) {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $user = $this->data['user'];
        // Set the subject of the mail.
        $this->subject = trans('Thanks for joining').' '.config('app.name', 'ET');
        $this->to( $user );

        return $this->view( 'mails.awaiting_approval_email' )->with(
            array(
                'title' => $this->subject,
                'user'  => $user,
            )
        );
    }
}
