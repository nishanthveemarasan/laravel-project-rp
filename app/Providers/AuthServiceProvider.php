<?php

namespace App\Providers;

<<<<<<< HEAD
use App\Models\User;
use App\Policies\UserPolicy;
=======
use App\Models\Comment;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use App\Policies\ProductPolicy;
>>>>>>> manage-product
use Laravel\Passport\Passport;
use App\Policies\UserActionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
<<<<<<< HEAD
        User::class => UserPolicy::class,
=======
        User::class => UserActionPolicy::class,
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Product::class => ProductPolicy::class
>>>>>>> manage-product
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

<<<<<<< HEAD
        Gate::before(function (User $user) {
            return $user->hasRole('admin');
=======
        Gate::before(function ($user) {
            if ($user->isAdmin()) {
                return true;
            }
>>>>>>> manage-product
        });
    }
}
