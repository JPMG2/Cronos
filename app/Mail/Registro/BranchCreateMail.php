<?php

namespace App\Mail\Registro;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BranchCreateMail extends Mailable
{
    use Queueable, SerializesModels;

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
            subject: 'Sucursal creada',
        );
    }

    public function build(): BranchCreateMail
    {
        return $this->markdown('emails.registro.branchcreatemail')
            ->with([
                'branch' => $this->branch,
            ]);
    }
}
