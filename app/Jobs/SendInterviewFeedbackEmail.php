<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;


use App\Mail\InterviewFeedbackMail;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;




class SendInterviewFeedbackEmail implements ShouldQueue
{
    

   use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $hrName;

    public function __construct($email, $hrName)
    {
        $this->email = $email;
        $this->hrName = $hrName;
    }

    public function handle()
    {
        Mail::to($this->email)
            ->send(new InterviewFeedbackMail($this->hrName));
    }
}
