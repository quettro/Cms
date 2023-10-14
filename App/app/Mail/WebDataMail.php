<?php

namespace App\Mail;

use App\Models\WebData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WebDataMail extends Mailable
{
    /**
     *
     */
    use Queueable, SerializesModels;

    /**
     * @param WebData $webData
     */
    public function __construct(public WebData $webData)
    {
        //
    }

    /**
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: config('app.name') . ' | Получена новая заявка №' . $this->webData->id,
        );
    }

    /**
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'mailable.WebData',
            with: [
                'webData' => $this->webData,
            ]
        );
    }
}
