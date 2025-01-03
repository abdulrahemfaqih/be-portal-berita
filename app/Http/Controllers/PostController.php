<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return (PostDetailResource::collection($posts->load("user:id,username")))
            ->response()
            ->setStatusCode(200);
    }

    public function show($id)
    {
        $post = Post::with("user:id,username")->findOrFail($id);
        return (new PostDetailResource($post))
            ->response()
            ->setstatusCode(200);
    }

    public function store(CreatePostRequest $request)
    {
        $validated = $request->validated();
        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);
        $post->load('user:id,username');
        return (new PostDetailResource($post))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $request->validated();
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return (new PostDetailResource($post))
            ->response()
            ->setstatusCode(200);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json([
            "message" => "postingan berhasil di hapus"
        ], 200);
    }
}
