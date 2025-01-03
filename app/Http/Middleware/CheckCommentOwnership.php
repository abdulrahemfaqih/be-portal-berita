<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCommentOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = auth()->id();
        $comment = Comment::findOrFail($request->id);
        if ($comment->user_id !== $userId) {
            return response()->json([
                "message" => "tidak memiliki akses!"
            ], 403);
        }
        return $next($request);
    }
}
