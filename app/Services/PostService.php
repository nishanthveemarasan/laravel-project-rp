<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Contracts\PostContract;
use App\Jobs\sendUserPostCreatedMailJob;

class PostService implements PostContract
{
    public function index()
    {
        return Post::withTrashed()->paginate(10);
    }

    public function store($data)
    {
        $post = auth()->user()->posts()->create($data);

        sendUserPostCreatedMailJob::dispatch($post, auth()->user());

        return ['message' => 'Post has been created Successfully!!.'];
    }

    public function userPosts(User $user)
    {
        $data = $user->posts()->paginate(10);
        return $data;
    }


    public function update($data, Post $post)
    {
        $post->update($data);

        return ['message' => 'Post updated successfully'];
    }

    public function edit(Post $post)
    {

        return $post;
    }
    public function delete(Post $post)
    {
        $post->delete();

        return ['message' => 'Post has been Deleted successfully'];
    }

    public function restore(Post $post)
    {
        $post->restore();

        return ['message' => 'Post has been enabld successfully'];
    }
}
