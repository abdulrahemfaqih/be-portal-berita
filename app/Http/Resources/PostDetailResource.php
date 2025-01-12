<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "image_path" => $this->path_image,
            "content" => $this->content,
            "created_at" => $this->created_at->format("Y-m-d"),
            "author_id" => $this->user_id,
            "author" => $this->whenLoaded("user"),
            "comments" => CommentResoure::collection($this->whenLoaded("comment")),
            "totalComment" => $this->comment_count
        ];
    }
}
