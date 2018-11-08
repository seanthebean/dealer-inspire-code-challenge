<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->data['email'], $this->data['full_name'])
            ->view('email.contact_form')
            ->text('email.contact_form_plaintext')
            ->with([
                'full_name' => $this->data['full_name'],
                'email' => $this->data['email'],
                'phone' => $this->data['phone'],
                'contact_message' => $this->data['message'], // the $message variable is already used, hence the different name
            ]);
    }
}
