<?php
//ContactFormMail.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Form Mail', //actual email subject
        );
    }

    public function build()
    {
        return $this->view('mails.contact_mail')
                    ->with([
                        'data' => $this->data //from ContactFormController.php
                    ])
                    ->subject('New Contact Enquiry');
    }

    public function attachments(): array
    {
        return [];
    }
}