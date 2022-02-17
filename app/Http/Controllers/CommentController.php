<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Requests\CommentCreateRequest;

class CommentController extends Controller
{

    public $result;
    public $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    /**
     * index
     *
     * @return array
     */
    public function index()
    {
        $this->authorize('viewAny', Comment::class);
        try {
            $this->result['data'] = $this->commentService->index();
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
        }

        return $this->result;
    }

    public function store(CommentCreateRequest $request, Post $post)
    {
        try {
            $this->result = $this->commentService->store($request->validated(), $post);
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
        }

        return $this->result;
    }
    public function delete(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);
        try {
            $this->result = $this->commentService->delete($comment);
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
        }

        return $this->result;
    }

    public function restore(Post $post, Comment $comment)
    {
        $this->authorize('restore', $comment);
        try {
            $this->result = $this->commentService->restore($comment);
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
        }

        return $this->result;
    }
}
