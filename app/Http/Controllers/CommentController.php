<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResoure;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request) {
        $request->validated();
        $request["user_id"] = auth()->id();
        $comment = Comment::create($request->all());

        return new CommentResoure($comment->load("user:id,username"));
    }

    public function update(UpdateCommentRequest $request, $id) {
        $request->validated();
        $comment = Comment::findOrFail($id);
        $comment->update($request->only("content"));
        return new CommentResoure($comment->load("user:id,username"));
    }

    public function destroy($id) {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json([
            "message" => "Komen berhasil di hapus",
        ], 200);
    }


}
