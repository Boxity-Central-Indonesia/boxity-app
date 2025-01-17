<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;

class updateProfileNotifier extends Notification
{
    use Queueable;
    public $profile, $url, $file;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($profile)
    {
        $this->profile = $profile;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ["mail",TelegramChannel::class];

        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        // dd($this->file);
        // return (new TelegramCollection())
        // ->message(['text' => "Ada transfer terbaru dari : ". $notifiable->name]);
        return TelegramMessage::create()
            // Optional recipient user id.
            ->to($notifiable->telegram_id)
            // Markdown supported.
            ->content("Halo " . $this->profile->name . ", Kamu telah berhasil mengubah informasi kamu. Jika kamu mengubah email atau password kamu, mohon agar menyimpan informasi tsb sebaik mungkin. Informasi ubah telah dikirim ke email kamu. Terima kasih.");

        // (Optional) Blade template for the content.
        // ->view('welcome', ['url' => $this->url])

        // (Optional) Inline Buttons
        // ->button('Lihat Detail Issue', $this->url);
        // ->button('Download File', $this->file);
        // (Optional) Inline Button with callback. You can handle callback in your bot instance
        // ->buttonWithCallback('Confirm', 'confirm_invoice ' . $this->invoice->id);
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
