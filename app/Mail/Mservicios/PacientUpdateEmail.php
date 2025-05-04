<?php

declare(strict_types=1);

namespace App\Mail\Mservicios;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class PacientUpdateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $person;

    /**
     * Create a new message instance.
     */
    public function __construct($person)
    {
        $this->person = $person;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Actualización de datos para '.$this->person->fullname,
        );
    }

    public function build(): self
    {
        return $this->markdown('emails.mservicios.patientupdateemail')
            ->with([
                'patient' => $this->person,
            ]);
    }
}
