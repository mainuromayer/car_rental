<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RentalConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rental;
    public $user_name;
    public $car_name;
    public $car_brand;

    public function __construct($rental, $user_name, $car_name, $car_brand)
    {
        $this->rental = $rental;
        $this->user_name = $user_name;
        $this->car_name = $car_name;
        $this->car_brand = $car_brand;
    }

    public function build()
    {
        return $this->view('emails.bookingConfirmMail')
                    ->with([
                        'rental' => $this->rental,
                        'user_name' => $this->user_name,
                        'car_name' => $this->car_name,
                        'car_brand' => $this->car_brand,
                    ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rental Confirm Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.bookingConfirmMail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

