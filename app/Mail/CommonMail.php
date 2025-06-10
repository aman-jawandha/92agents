<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use InvalidArgumentException;

/**
 * A common mailable class for sending emails with various content sections.
 *
 * This class allows for flexible email composition with optional sections:
 * - Section 1: Title and body text.
 * - Section 2: A table (data structure not specified).
 * - Section 3: A secondary title and body text.
 *
 * At least one of these content sections must be provided.  Footer information
 * like tagline, phone, address and footer text have default values and can be
 * overridden.
 */
class CommonMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string|null The email subject. */
    public $subject;

    /** @var string|null The primary title. */
    public ?string $title;

    /** @var string|null The primary body text. */
    public ?string $body;

    /** @var array|null The table data. */
    public ?array $table;

    /** @var string|null The secondary title. */
    public ?string $title_2;

    /** @var string|null The secondary body text. */
    public ?string $body_2;

    /** @var string The email tagline. Defaults to the subject or a generic message. */
    public string $tagline;

    /** @var string The phone number. Defaults to a predefined value. */
    public string $phone;

    /** @var string The address. Defaults to a predefined value. */
    public string $address;

    /** @var string The footer text. Defaults to a predefined value. */
    public string $footer_text;

    /** @var bool Whether to include an unsubscribe link (not implemented). */
    public bool $unsubscribe;

    /** @var array  Attachments for the email. */
    public $attachments;

    /**
     * Create a new message instance.
     *
     * @param null|string $subject The email subject.
     * @param null|string $title The primary title.
     * @param null|string $body The primary body text.
     * @param null|array $table The table data.  An array of arrays, where each inner array
     *                          represents a row and contains two elements: the label and the value.
     *                          Example: `[["Label 1", "Value 1"], ["Label 2", "Value 2"]]`.
     * @param null|string $title_2 The secondary title.
     * @param null|string $body_2 The secondary body text.
     * @param null|string $tagline The email tagline.
     * @param null|string $phone The phone number.
     * @param null|string $address The address.
     * @param null|string $footer_text The footer text.
     * @param null|bool $unsubscribe Whether to include an unsubscribe link.
     * @param null|array $attachments Array of attachments.
     *
     * @throws InvalidArgumentException If invalid content combinations are provided.
     */
    public function __construct(
        ?string $subject = null,
        ?string $title = null,
        ?string $body = null,
        ?array $table = null,
        ?string $title_2 = null,
        ?string $body_2 = null,
        ?string $tagline = null,
        ?string $phone = null,
        ?string $address = null,
        ?string $footer_text = null,
        ?bool $unsubscribe = null,
        ?array $attachments = null,
    ) {
        // Validation rules
        if ($title != null && $body == null) {
            throw new InvalidArgumentException("Title provided without body content.");
        }

        if ($title_2 != null && $body_2 == null) {
            throw new InvalidArgumentException("Title 2 provided without body 2 content.");
        }

        if (($table == null || $table == []) && $title == null && $body == null) {
            throw new InvalidArgumentException("Either Section 1 (title and body) or Section 2 (table) must be present.");
        }

        if ($title == null && $body == null && ($table == null || $table == []) && $title_2 == null && $body_2 == null) {
            throw new InvalidArgumentException("At least one content section (Section 1, 2, or 3) must be present.");
        }

        $this->subject = $subject;
        $this->title = $title;
        $this->body = $body;
        $this->table = $table;
        $this->title_2 = $title_2;
        $this->body_2 = $body_2;

        $this->tagline = $tagline ?? $subject ?? "You got a mail from 92 Agents";
        $this->phone = $phone ?? "(615) 538-8208";
        $this->address = $address ?? "Zippy Infotech Inc, 30 N Gould ST., <br>Suite Sheridan, WY, 82801 Sheridan";
        $this->footer_text = $footer_text ?? "This email is from 92 Agents. If you received this by mistake, no  required.<br>If you need to unsubscribe from such mails, please notify us.";
        $this->unsubscribe = $unsubscribe ?? false;
        $this->attachments = $attachments ?? [];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            cc: ['ceo@cyberfort.co.in'],
            subject: $this->subject ?? 'You got a mail from 92 Agents',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.commonm_mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return $this->attachments;
    }
}
