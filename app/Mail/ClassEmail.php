<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClassEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;

    public function __construct($messageContent)
    {
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->view('mail-template.mail')
                    ->with([
                        'quizName' => $this->messageContent['quizName'],
                        'courseName' => $this->messageContent['courseName'],
                    ]);
    }
}
