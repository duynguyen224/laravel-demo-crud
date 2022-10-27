<?php

namespace App\Listeners;

use App\Events\RegisterUserProcessed;
use App\Mail\RegisterMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRegisterEmailNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    // public $connection = 'sqs';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    // public $queue = 'listeners';

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    // public $delay = 60;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\RegisterUserProcessed  $event
     * @return void
     */
    public function handle(RegisterUserProcessed $event)
    {
        $this->release(30);
        $user = $event->user;
        Mail::to($user)->send(new RegisterMail($user));
    }

    /**
     * Get the name of the listener's queue connection.
     *
     * @return string
     */
    // public function viaConnection()
    // {
    //     return 'sqs';
    // }

    /**
     * Get the name of the listener's queue.
     *
     * @return string
     */
    // public function viaQueue()
    // {
    //     return 'listeners';
    // }
}
