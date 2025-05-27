<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\City; // Import City model
use App\Models\Citizen; // Import Citizen model

class CitizenReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reportData;
    public $city;

    /**
     * Create a new message instance.
     */
    public function __construct(City $city)
    {
        $this->city = $city;
        // Generate report data
        $citizens = $city->citizens()->orderBy('name', 'asc')->get();

        $reportContent = "Reporte de Ciudadanos para " . $this->city->name . "\n\n";
        if ($citizens->isEmpty()) {
            $reportContent .= "No hay ciudadanos registrados en esta ciudad.\n";
        } else {
            foreach ($citizens as $citizen) {
                $reportContent .= "- " . $citizen->name . "\n";
            }
        }
        $this->reportData = $reportContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reporte de Ciudadanos para ' . $this->city->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.report', // This points to resources/views/emails/report.blade.php
            with: [
                'reportData' => $this->reportData,
                'city' => $this->city,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}