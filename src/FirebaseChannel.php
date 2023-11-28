<?php

namespace Veldman\FirebaseCloudMessaging;

use Google\Client;
use Google\Service\FirebaseCloudMessaging;
use Google\Service\FirebaseCloudMessaging\SendMessageRequest;
use Illuminate\Notifications\Notification;
use RuntimeException;

class FirebaseChannel
{
    public function send(object $notifiable, Notification $notification): void
    {
        $route = $notifiable->routeNotificationFor('firebase', $notification);

        $data = $this->getData($notifiable, $notification);

        $client = new Client();
        $client->setAuthConfig('./google.json');
        $client->addScope(FirebaseCloudMessaging::FIREBASE_MESSAGING);
        $service = new FirebaseCloudMessaging($client);

        $data = [
            'message' => [
                'token' => $this->getDeviceTokens($route)[0],
                'notification' => $data
            ]
        ];
        $request = new SendMessageRequest($data);

        $json = file_get_contents('./google.json');
        $config = json_decode($json);

        $service->projects_messages->send('projects/' . $config->project_id, $request);
    }

    protected function getData($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toFirebase')) {
            return $notification->toFirebase($notifiable)->toArray();
        }

        if (method_exists($notification, 'toArray')) {
            return $notification->toArray($notifiable);
        }

        throw new RuntimeException('Notification is missing toArray method.');
    }

    protected function getDeviceTokens($routes): array
    {
        if (is_array($routes)) {
            return $routes;
        }

        return [$routes];
    }
}
