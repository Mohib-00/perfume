<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $order; // Add this property to hold the order data

    /**
     * Create a new message instance.
     *
     * @param  mixed  $order
     */
    public function __construct($order)
    {
        $this->order = $order;  // Assign the passed order to the property
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Success',  // Define the subject of the email
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.order-success',  // Specify the view to use for the email body
            with: [
                'order' => $this->order,  // Pass the order data to the view
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];  // If you want to add attachments, you can define them here
    }
}
