<?php

namespace Modules\Balance\Emails;

use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendingOtpForWithdrawalMail extends Mailable
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
        $this->subject($this->details['subject'])->view('balance::balance.mail.send_withdrawal_otp_mail',$this->details);
        return $this;
    }
}
