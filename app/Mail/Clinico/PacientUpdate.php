<?php

declare(strict_types=1);

namespace App\Mail\Clinico;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class PacientUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $patiente;

    /**
     * Create a new message instance.
     */
    public function __construct($patiente)
    {
        $this->patiente = $patiente;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Actualización de datos '.$this->patiente->person->fullName,
        );
    }

    public function build(): self
    {
        return $this->markdown('emails.mservicios.patientupdateemail')
            ->with([
                'patient' => $this->patiente,
            ]);
    }
}
