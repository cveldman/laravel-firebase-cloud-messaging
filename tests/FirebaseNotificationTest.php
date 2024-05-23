<?php

namespace Veldman\FirebaseCloudMessaging\Tests;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Veldman\FirebaseCloudMessaging\FirebaseNotification;

class FirebaseNotificationTest extends TestCase
{
    public function testViaTrait()
    {
        Notification::fake();

        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.nl',
            'password' => Hash::make('password'),
        ]);

        $user->notify(new FirebaseNotification('Title', 'Body'));

        Notification::assertSentTimes(FirebaseNotification::class, 1);
    }

    public function testWithFacade()
    {
        Notification::fake();

        Notification::route('firebase', '/topics/1')
            ->notify(new FirebaseNotification('Title', 'Body'));

        Notification::route('firebase', ['token1', 'token2'])
            ->notify(new FirebaseNotification('Title', 'Body'));

        Notification::assertSentTimes(FirebaseNotification::class, 2);
    }
}
