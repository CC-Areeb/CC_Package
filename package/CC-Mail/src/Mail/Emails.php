<?php

namespace CooperativeComputing\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Emails extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $validator;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($validator)
    {
        $this->validator = $validator;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $this->from($this->validator['sender'])
            ->subject($this->validator['subject'])
            ->to($this->validator['to'])
            ->markdown('cc-email::emailWelcome');
        return $this;
    }
}
