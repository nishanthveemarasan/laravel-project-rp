<?php

namespace App\Listeners;

use App\Events\UserPostCreatedEmail;
use App\Events\UserWelcomeEvent;
use App\Mail\UserPostCreated;
use App\Mail\UserRegisterSuccessfulMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class EventSubscriber
{
    public function handleUserWelcome(UserWelcomeEvent $event)
    {
        Mail::to($event->user->email)
            ->send(new UserRegisterSuccessfulMail($event->user));
    }

    public function handleUserPostCreated(UserPostCreatedEmail $event)
    {
        Mail::to($event->user->email)
            ->send(new UserPostCreated($event->post, $event->user));
    }

    public function subscribe($events)
    {
        return [
            UserWelcomeEvent::class => 'handleUserWelcome',
            UserPostCreatedEmail::class => 'handleUserPostCreated',
        ];
    }
}
