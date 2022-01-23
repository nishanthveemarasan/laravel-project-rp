<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use App\Events\UserPostCreatedEmail;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class sendUserPostCreatedMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
     * after_commit
     *
     * @var bool
     */
    public $after_commit  = true;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        event(new UserPostCreatedEmail($this->post, $this->user));
    }
}
