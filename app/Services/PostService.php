<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Contracts\PostContract;
use App\Jobs\sendUserPostCreatedMailJob;

class PostService implements PostContract
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return Post::withTrashed()->paginate(10);
    }

    /**
     * store
     *
     * @param  array $data
     * @return array
     */
    public function store($data)
    {
        $post = auth()->user()->posts()->create($data);

        sendUserPostCreatedMailJob::dispatch($post, auth()->user());

        return ['message' => 'Post has been created Successfully!!.'];
    }

    /**
     * userPosts
     *
     * @param  User $user
     * @return void
     */
    public function userPosts(User $user)
    {
        $data = $user->posts()->paginate(10);
        return $data;
    }


    /**
     * update
     *
     * @param  array $data
     * @param  Post $post
     * @return array
     */
    public function update($data, Post $post)
    {
        $post->update($data);

        return ['message' => 'Post updated successfully'];
    }

    /**
     * edit
     *
     * @param  Post $post
     * @return void
     */
    public function edit(Post $post)
    {

        return $post;
    }
    /**
     * delete
     *
     * @param  Post $post
     * @return array
     */
    public function delete(Post $post)
    {
        $post->delete();

        return ['message' => 'Post has been Deleted successfully'];
    }

    /**
     * restore
     *
     * @param  Post $post
     * @return array
     */
    public function restore(Post $post)
    {
        $post->restore();

        return ['message' => 'Post has been enabld successfully'];
    }
}
