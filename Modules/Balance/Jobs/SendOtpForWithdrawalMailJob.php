<?php

namespace Modules\Balance\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Balance\Emails\SendingOtpForWithdrawalMail;
use Mail;

class SendOtpForWithdrawalMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details){
        $this->details =  $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $otp_mail = new SendingOtpForWithdrawalMail($this->details);
        Mail::to(env('OWNER_MAIL_ADDRESS'))
        ->send($otp_mail);  
    }
}
    