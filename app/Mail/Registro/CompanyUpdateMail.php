<?php

declare(strict_types=1);

namespace App\Mail\Registro;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class CompanyUpdateMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $company;

    /**
     * Create a new message instance.
     */
    public function __construct($company)
    {
        $this->company = $company;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Datos de compañia actualizados',
        );
    }

    public function build(): self
    {
        return $this->markdown('emails.registro.companyupdatemail')
            ->with(
                [
                    'company' => $this->company,
                ],
            );
    }
}
