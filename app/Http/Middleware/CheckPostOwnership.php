<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPostOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = Post::findOrFail($request->id);
        if ($post->user_id !== auth()->id()) {
            return response()->json([
                "message" => "Tidak memiliki akses"
            ], 403);
        }
        return $next($request);
    }
}
