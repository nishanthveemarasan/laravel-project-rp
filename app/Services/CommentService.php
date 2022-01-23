<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Comment;

class CommentService
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return Comment::with('post')
            ->without('post.user', 'post.comments')
            ->withTrashed()->paginate(10);
    }

    /**
     * store
     *
     * @param  array $data
     * @param  Post $post
     * @return void
     */
    public function store($data, Post $post)
    {
        $data['user_id'] = auth()->id();

        $post->comments()->create($data);

        return ['message' => 'Comment created Successfully!!.'];
    }

    public function delete(Comment $comment)
    {
        $comment->delete();

        return ['message' => 'Comment deleted Successfully!!.'];
    }

    public function restore(Comment $comment)
    {
        $comment->restore();

        return ['message' => 'Comment restored Successfully!!.'];
    }
}
