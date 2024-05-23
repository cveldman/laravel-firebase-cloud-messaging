# Firebase Cloud Messaging

Package to send Firebase Cloud Messaging notification from Laravel.

### Trait

You can send messages to a token or a array of tokens, you can also send messages to a topic.

```php
class User extends Authenticatable
{
    use Notifiable;
 
    public function routeNotificationForFirebase(Notification $notification): array|string
    {
        // Return token or topic only
        return $this->firebase_token;
 
        // Return array of tokens or topics
        return $this->notificationTokens->pluck('token');
    }
}
```

```php
$user->notify(new FirebaseNotification($title, $body));
```

### On-Demand Notifications

Sometimes you may need to send a notification to someone who is not stored as a "user" of your application. Using the `Notification` facade's `route` method, you may specify ad-hoc notification routing information before sending the notification:

```php
use Illuminate\Support\Facades\Notification;

Notification::route('firebase', '/topics/news')
            ->notify(new FirebaseMessage('Title', 'Body'));
```

### Progress

- Event for invalid registration tokens

[Google SDK](https://github.com/googleapis/google-api-php-client)

[Cleaning up unused Google services](https://github.com/googleapis/google-api-php-client/tree/main?tab=readme-ov-file#cleaning-up-unused-services)