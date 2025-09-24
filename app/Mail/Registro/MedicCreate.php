<?php

declare(strict_types=1);

namespace App\Mail\Registro;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class MedicCreate extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public $medic;

    public function __construct($medic)
    {
        $this->medic = $medic;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenido/a '.$this->medic->person->fullname,
        );
    }

    public function build(): self
    {
        return $this->markdown('emails.registro.mediccreate')
            ->with(
                [
                    'medic' => $this->medic,
                ]
            );
    }
}
