<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\Notification;
use App\Notifications\ScrapOrderNotification

class SendScrapOrderNotifiction
{
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $adminUser =  User::where('role_id', 1)->first();
        Notification::send($adminUser, new ScrapOrderNotification($event->user));
    }
}
