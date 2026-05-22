<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmEmailClient extends Mailable
{
    use Queueable, SerializesModels;

    private $client;
    private $token;
    private $confirmUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Client $client, $token)
    {
        $this->client = $client;
        $this->token = $token;
        $this->confirmUrl = route('client.email.verify', ['token' => $token]);
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Confirme seu E-mail - Cartório Central')
            ->view('emails.confirm-email-client', [
                'client' => $this->client,
                'confirmUrl' => $this->confirmUrl,
                'token' => $this->token,
            ]);
    }
}
