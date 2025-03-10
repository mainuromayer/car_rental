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
    public $is_admin;

    public function __construct($rental, $user_name, $car_name, $car_brand, $is_admin = false)
    {
        $this->rental = $rental;
        $this->user_name = $user_name;
        $this->car_name = $car_name;
        $this->car_brand = $car_brand;
        $this->is_admin = $is_admin;
    }

    public function build()
    {
        if ($this->is_admin) {
            // Admin email template
            return $this->view('emails.adminBookingConfirmMail')
                        ->with([
                            'rental' => $this->rental,
                            'user_name' => $this->user_name,
                            'car_name' => $this->car_name,
                            'car_brand' => $this->car_brand,
                        ]);
        } else {
            // Customer email template (already existing)
            return $this->view('emails.bookingConfirmMail')
                        ->with([
                            'rental' => $this->rental,
                            'user_name' => $this->user_name,
                            'car_name' => $this->car_name,
                            'car_brand' => $this->car_brand,
                        ]);
        }
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->is_admin ? 'New Car Rental Booking' : 'Rental Confirm Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: $this->is_admin ? 'emails.adminBookingConfirmMail' : 'emails.bookingConfirmMail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}