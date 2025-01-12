<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostDetailResource;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(["user:id,username", "comment.user:id,username"])
            ->withCount("comment")
            ->get();
        return (PostDetailResource::collection($posts))
            ->response()
            ->setStatusCode(200);
    }

    public function show($id)
    {
        $post = Post::with(['user:id,username', 'comment.user:id,username'])
        ->withCount('comment')
        ->findOrFail($id);
        return (new PostDetailResource($post))
            ->response()
            ->setstatusCode(200);
    }

    public function store(CreatePostRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $hashedName = Str::random(20) . "." . $file->getClientOriginalExtension();
            $filePath = $file->storeAs("uploads", $hashedName, "public");
        } else {
            $filePath = null;
        }

        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            "path_image" => $filePath
        ]);
        $post->load('user:id,username');
        return (new PostDetailResource($post))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdatePostRequest $request, $id)
    {

        $validated = $request->validated();
        $post = Post::findOrFail($id);

        if ($request->hasFile("image")) {
        
            if ($post->path_image) {
                Storage::disk("public")->delete($post->path_image) ;
            }

            $file = $request->file("image");
            $hashedName = Str::random(20) . "." .  $file->getClientOriginalExtension();
            $filePath = $file->storeAs("uploads", $hashedName, "public");

            $validated["path_image"] = $filePath;
        }

        $post->update($validated);
        return (new PostDetailResource($post))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->path_image) {
            Storage::disk('public')->delete($post->path_image);
        }
        $post->delete();
        return response()->json([
            "message" => "postingan berhasil di hapus"
        ], 200);
    }
}
