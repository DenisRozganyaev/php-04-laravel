<?php

namespace App\Notifications\Orders\Created;

use App\Enums\OrderStatus;
use App\Services\Contracts\InvoicesServiceContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\Telegram\TelegramMessage;

class CustomerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected InvoicesServiceContract $invoicesService)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return $notifiable?->user?->telegram_id ? ['mail', 'telegram'] : ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        logs()->info(self::class);

        $invoice = $this->invoicesService->generate($notifiable);

        return (new MailMessage)
                    ->greeting("Hello, $notifiable->name $notifiable->surname")
                    ->line('Your order was created!')
                    ->lineIf(
                        $notifiable->status->getName() === OrderStatus::Paid->value,
                        'And successfully paid!'
                    )
                    ->line('You can see the invoice file in attachments')
                    ->attach(Storage::disk('public')->path($invoice->filename), [
                        'as' => $invoice->filename,
                        'mime' => 'application/pdf'
                    ]);
//                    ->action('Notification Action', url('/'))
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to($notifiable->user->telegram_id)
            ->content("Hello, $notifiable->name $notifiable->surname")
            ->line('Your order was created!')
            ->line('You can see the invoice file in attachments');
    }
}
