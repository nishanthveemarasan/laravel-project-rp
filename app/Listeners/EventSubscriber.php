<?php

namespace App\Listeners;

use App\Events\UserWelcomeEvent;
use App\Mail\UserRegisterSuccessfulMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventSubscriber
{
    public function handleUserWelcome(UserWelcomeEvent $event)
    {
        Mail::to($event->user->email)
            ->send(new UserRegisterSuccessfulMail($event->user));
    }

    public function subscribe($events)
    {
        return [
            UserWelcomeEvent::class => 'handleUserWelcome',
        ];
    }
}
