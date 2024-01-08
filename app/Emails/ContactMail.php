<?php

namespace Modules\Contact\app\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public array $data = []
    ){
        $this->subject($data['title'] ?? 'Contact');
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('contact::emails.contact', [
            'data' => $this->data
        ]);
    }
}
