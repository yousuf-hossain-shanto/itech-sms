# itech-sms

### Installation

`composer require yhshanto/itech-sms`

### Configuration

You must add bellow code to your config/services.php

```php
'itech' => [
    'sms' => [
        'endpoint' => 'https://api.infobip.com/api/v3/sendsms/plain?user=demo&password=demo&sender=Azzoa&SMSText=[message]&GSM=[to]&type=longSMS'
    ]
]
```

`[message]` will replaced by original message
`[to]` will replaced by notifiable route

Add `itech` in via method of your notification class

```php
/**
 * Get the notification's delivery channels.
 *
 * @param  mixed  $notifiable
 * @return array
 */
public function via($notifiable)
{
    return ['itech'];
}
```

also add this method in your notification class which will return a sms string

```php
/**
 * Get the sms representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return array|MailMessage|\NotificationChannels\Fcm\FcmMessage
 */
public function toItechSms($notifiable)
{
    return 'Write somthing here';
}
```

You must have `phone` attribute or `routeNotificationForItech` method (return a valid phone number) in your notifiable class like `App\User` 
