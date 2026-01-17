<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterviewFeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

     public $hrName;

    public function __construct($hrName)
    {
        $this->hrName = $hrName;
    }

    public function build()
    {
        return $this->subject('Request for Interview Feedback')
            ->view('emails.interview_feedback');
    }
}
