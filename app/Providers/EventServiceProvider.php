<?php

namespace App\Providers;

use App\Events\RegisterUserProcessed;
use App\Listeners\SendRegisterEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use function Illuminate\Events\queueable;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // Register for event (key) => (listener)
        RegisterUserProcessed::class => [
            SendRegisterEmailNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // Register manually
        // Event::listen(
        //     RegisterUserProcessed::class,
        //     [SendRegisterEmailNotification::class, "handle"]
        // );

        // Event::listen(queueable(function (RegisterUserProcessed $event) {
        //     //
        //     dd("event register user processed");
        // })->onConnection('redis')->onQueue('podcasts')->delay(now()->addSeconds(10)));
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
        // return true; // auto discover --> all listener will be scanned
    }
}
