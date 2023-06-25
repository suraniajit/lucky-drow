<?php

namespace Modules\Balance\Emails;

use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendingOtpForDipositMail extends Mailable
{
    protected $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details){
        $this->details =  $details;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->details['subject'])->view('balance::balance.mail.send_otp_for_deposit_mail',$this->details);
        return $this;
    }
}
