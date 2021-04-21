<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('video')) {
            $file = $request->video;
            $fileName = time() . '_'  . $file->getClientOriginalName();
            $file->storeAs('public/posts', $fileName);

            $data['video'] = $fileName;
        }

        $post = auth()->user()->posts()->create($data);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @param  App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();

        if ($request->hasFile('video')) {
            // delete the old video
            Storage::delete('public/posts/' . $post->video);

            // upload new one
            $file = $request->video;
            $fileName = time() . '_'  . $file->getClientOriginalName();
            $file->storeAs('public/posts', $fileName);

            $data['video'] = $fileName;
        } else {
            unset($request['video']);
        }

        if ($updatedPost = tap($post)->update($data)) {
            return response()->json($updatedPost);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->delete()) {
            // delete video too
            Storage::delete('public/posts/' . $post->video);

            return response()->json(['success' => 'Post deleted successfully']);
        }
    }
}