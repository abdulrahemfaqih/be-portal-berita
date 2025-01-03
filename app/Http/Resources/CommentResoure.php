<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResoure extends JsonResource
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
            "content" => $this->content,
            "user_id" => $this->user_id,
            "post_id" => $this->post_id,
            "created_at" => $this->created_at->format("Y-m-d H:i:s"),
            "user" => $this->whenLoaded("user")

        ];
    }
}
