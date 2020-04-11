<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FamilyRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $family_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($family_code)
    {
        $this->family_code = $family_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = __('Request to organize and coordinate your child\'s life');
        return $this->subject($subject)->markdown('emails.family-request-alert');
    }
}
