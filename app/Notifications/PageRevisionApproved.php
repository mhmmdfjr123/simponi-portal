<?php

namespace App\Notifications;

use App\Models\PageRevision;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Notification class to handle notification when the page revision has been approved
 *
 * @package App\Notifications
 * @author efriandika
 */
class PageRevisionApproved extends Notification implements ShouldQueue
{
    use Queueable;

    protected $approvalUser;
    protected $pageRevision;

    /**
     * Create a new notification instance.
     *
     * @param $approvalUser
     * @param PageRevision $pageRevision
     */
    public function __construct($approvalUser, PageRevision $pageRevision)
    {
        $this->approvalUser = $approvalUser;
        $this->pageRevision = $pageRevision;
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
            ->subject('Revisi Halaman telah disetujui')
            ->line($this->approvalUser->name.' telah menyetujui revisi halaman: "'.$this->pageRevision->title.'"')
            ->action('Lihat', route('backoffice.page.index'))
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
