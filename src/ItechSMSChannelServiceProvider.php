<?php

namespace YHShanto\ItechSMS;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class ItechSMSChannelServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('itech', function ($app) {
                return new Channels\ItechSMSChannel($this->app['config']['services.itech.sms']);
            });
        });
    }
}
