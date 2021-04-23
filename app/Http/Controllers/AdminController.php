<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\PostController;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the home page for admin
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the home page for listing posts
     */
    public function posts()
    {
        $posts = Post::with(['user' => function ($q) {
            $q->select('id', 'name');
        }])->orderBy('created_at')->paginate(20);

        return view('admin.posts.view', compact('posts'));
    }

    /**
     * Show the  page for creating post
     */
    public function createPost()
    {
        return view('admin.posts.create');
    }

    /**
     * Show the  page for edit post
     */
    public function editPost(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Delete post
     */
    public function deletePost(Post $post)
    {
        $postApiController = new PostController();

        return $postApiController->destroy($post);
    }
}
