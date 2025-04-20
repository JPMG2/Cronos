<?php

declare(strict_types=1);

namespace App\Mail\Mservicios;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class PacientNewEmail extends Mailable
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
            subject: 'Bienvenido/a '.$this->person->fullName,
        );
    }

    public function build(): self
    {
        return $this->markdown('emails.mservicios.patientnewemail')
            ->with([
                'patient' => $this->person,
            ]);
    }
}
