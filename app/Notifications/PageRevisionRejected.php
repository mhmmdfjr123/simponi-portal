<?php

namespace App\Notifications;

use App\Models\PageRevision;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Notification class to handle notification when the page revision has been rejected
 *
 * @package App\Notifications
 * @author efriandika
 */
class PageRevisionRejected extends Notification implements ShouldQueue
{
    use Queueable;

    protected $approvalUser;
    protected $pageRevision;
    protected $reason;

    /**
     * Create a new notification instance.
     *
     * @param $approvalUser
     * @param PageRevision $pageRevision
     * @param string $reason
     */
    public function __construct($approvalUser, PageRevision $pageRevision, string $reason)
    {
        $this->approvalUser = $approvalUser;
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
            ->subject('Revisi Halaman telah ditolak')
            ->line($this->approvalUser->name.' menolak revisi pada halaman "'.$this->pageRevision->title.'"')
            ->line('Alasan: "'.$this->reason.'"')
            ->action('Lihat Daftar Revisi Halaman', route('backoffice.page.revision.approval'))
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
