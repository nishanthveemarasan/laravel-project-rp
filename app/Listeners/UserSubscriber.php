<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\UserCreationSuccessMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserSubscriber
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handleUserCreated(UserCreated $event)
    {
        Mail::to($event->user->email)
            ->send(new UserCreationSuccessMail($event->user));
    }

    public function subscribe($events)
    {
        return [
            UserCreated::class => 'handleUserCreated'
        ];
    }
}
