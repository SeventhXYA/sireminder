<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $url;

    /**
     * Create a new message instance.
     *
     * @param string $url
     * @return void
     */
    public function __construct($username, $url)
    {
        $this->username = $username;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('SIREMINDER Password Reset')->view('emails.forget');
    }
}
