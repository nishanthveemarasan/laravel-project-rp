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
    /**
     * handleUserWelcome
     *
     * @param  UserWelcomeEvent $event
     * @return void
     */
    public function handleUserWelcome(UserWelcomeEvent $event)
    {
        Mail::to($event->user->email)
            ->send(new UserRegisterSuccessfulMail($event->user));
    }

    /**
     * handleUserPostCreated
     *
     * @param  UserPostCreatedEmail $event
     * @return void
     */
    public function handleUserPostCreated(UserPostCreatedEmail $event)
    {
        Mail::to($event->user->email)
            ->send(new UserPostCreated($event->post, $event->user));
    }

    /**
     * subscribe
     *
     * @param  mixed $events
     * @return array
     */
    public function subscribe($events)
    {
        return [
            UserWelcomeEvent::class => 'handleUserWelcome',
            UserPostCreatedEmail::class => 'handleUserPostCreated',
        ];
    }
}
