<?php

namespace App\Notifications;

use App\Models\PageRevision;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Notification class to handle notification when the page revision has been created
 *
 * @package App\Notifications
 * @author efriandika
 */
class PageRevisionSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    protected $author;
    protected $pageRevision;
    protected $reason;

    /**
     * Create a new notification instance.
     *
     * @param $pageRevisionAuthor
     * @param PageRevision $pageRevision
     * @param string $reason
     */
    public function __construct($pageRevisionAuthor, PageRevision $pageRevision, string $reason)
    {
        $this->author = $pageRevisionAuthor;
        $this->pageRevision = $pageRevision;
        $this->reason = $reason;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Permintaan Persetujuan Revisi Halaman')
                    ->line($this->author->name.' membuat revisi pada halaman "'.$this->pageRevision->title.'" dengan alasan:')
                    ->line('"'.$this->reason.'"')
                    ->line('Halaman tersebut sedang menunggu untuk diverifikasi oleh anda.')
                    ->action('Lihat Daftar Persetujuan', route('backoffice.page.revision.approval'))
                    ->line('Terima Kasih.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
