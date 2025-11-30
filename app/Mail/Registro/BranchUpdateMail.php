<?php

declare(strict_types=1);

namespace App\Mail\Registro;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class BranchUpdateMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $branch;

    /**
     * Create a new message instance.
     */
    public function __construct($branch)
    {
        $this->branch = $branch;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Datos de sucursal actualizados',
        );
    }

    public function build(): self
    {
        return $this->markdown('emails.registro.branchupdatemail')
            ->with(
                [
                    'branch' => $this->branch,
                ],
            );
    }
}
