<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $data = $request->validated();
        $comment = auth()->user()->comments()->create($data);

        return response()->json($comment->load('user'), 201);
    }


    /**
     * Get the singe resource to edit
     *
     * @param  App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        if (!Comment::checkPosterIdentity($comment)) {
            return response()->json(['message' => "Unauthorized"], 403);
        }

        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CommentRequest  $request
     * @param  App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        if (!Comment::checkPosterIdentity($comment)) {
            return response()->json(['message' => "Unauthorized"], 403);
        }

        $data = $request->validated();
        $updatedComment = tap($comment)->update($data);

        return response()->json($updatedComment->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if (!Comment::checkPosterIdentity($comment)) {
            return response()->json(['message' => "Unauthorized"], 403);
        }

        if ($comment->delete()) {
            return response()->json(['success' => 'Comment deleted successfully']);
        }
    }
}
