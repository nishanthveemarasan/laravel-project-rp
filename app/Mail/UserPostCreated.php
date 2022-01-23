<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UserPostCreated extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * post
     *
     * @var Post
     */
    public $post;    
    /**
     * user
     *
     * @var User
     */
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->post->title;
        return $this->subject($subject)
            ->view('email.user-post-created');
    }
}
