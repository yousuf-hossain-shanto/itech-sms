<?php

namespace YHShanto\ItechSMS\Channels;

class ItechSMSChannel
{
    /**
     * Itech Sms Credentials.
     *
     * @var string
     */
    protected $config;

    /**
     * Create a new Itech Sms channel instance.
     *
     * @param array $config
     * @param string $from
     * @return void
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     */
    public function send($notifiable, $notification)
    {

        $to = $notifiable->routeNotificationFor('itech', $notification);
        $to = $to ? $to : $notifiable->phone;

        if (!$to) {
            return;
        }

        $message = $notification->toItechSms($notifiable);

        $endpoint = $this->config['endpoint'];
        $endpoint = str_replace('[to]', $to, $endpoint);
        $endpoint = str_replace('[message]', urlencode($message), $endpoint);

        return file_get_contents($endpoint);
    }
}
