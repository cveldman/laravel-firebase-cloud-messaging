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
        Http::fake([
            '*' => Http::response('Hello World', 200),
        ]);

        $user = User::create([
            'name' => 'test',
            'email' => 'test@test.nl',
            'password' => Hash::make('password'),
        ]);

        $user->notify(new FirebaseNotification('Title', 'Body'));

        Http::assertSent(function (Request $request) {
            return $request->url() == 'https://fcm.googleapis.com/fcm/send';
        });
    }

    public function testWithFacade()
    {
        Http::fake([
            '*' => Http::response('Hello World', 200),
        ]);

        Notification::route('firebase', 'token123')
            ->notify(new FirebaseNotification('Title', 'Body'));

        Notification::route('firebase', ['token123', 'token345'])
            ->notify(new FirebaseNotification('Title', 'Body'));

        Http::assertSent(function (Request $request) {
            return $request->url() == 'https://fcm.googleapis.com/fcm/send';
        });
    }
}
