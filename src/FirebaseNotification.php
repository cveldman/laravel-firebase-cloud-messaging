<?php

namespace Veldman\FirebaseCloudMessaging;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class FirebaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $title,
        public string $body
    )
    {
    }

    public function via(object $notifiable): array
    {
        return [FirebaseChannel::class];
    }

    public function toFirebase(object $notifiable): FirebaseMessage
    {
        return (new FirebaseMessage)
            ->title($this->title)
            ->body($this->body);
    }
}
