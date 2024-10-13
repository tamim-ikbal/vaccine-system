<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use stdClass;

class VaccinateDateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public function __construct(
        public stdClass $vaccineCenter,
        public stdClass $registration,
        public stdClass $vaccine,
        public Carbon $schedule_at
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting(__('Hello :name,', ['name' => $notifiable->name]))
            ->line(__('You have a schedule for :disease vaccine :dose',
                ['dose' => $this->vaccine->vaccine_dose_name, 'disease' => $this->vaccine->diseases_display_name]
            ))
            ->line(__('Schedule At: :date', ['date' => $this->schedule_at->format('d F Y, H:i a')]))
            ->line(__('Vaccine Center: :name', ['name' => $this->vaccineCenter->name]))
            ->line(__('Vaccine Name: :name', ['name' => $this->vaccine->name]))
            ->line(__('Thank you for using our application!'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
