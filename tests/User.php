<?php

namespace Veldman\FirebaseCloudMessaging\Tests;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function routeNotificationForFirebase(Notification $notification): array|string
    {
        return 'testtoken';
    }
}
