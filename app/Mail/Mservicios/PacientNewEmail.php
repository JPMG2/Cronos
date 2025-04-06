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

    public $pacient;

    /**
     * Create a new message instance.
     */
    public function __construct($pacient)
    {
        $this->pacient = $pacient;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenido/a '.$this->pacient->person->fullName,
        );
    }

    public function build(): self
    {
        return $this->markdown('emails.mservicios.patientnewemail')
            ->with([
                'patient' => $this->pacient,
            ]);
    }
}
