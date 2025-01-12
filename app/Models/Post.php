<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "posts";
    protected $primaryKey = "id";
    protected $fillable = [
        "title",
        "content",
        "user_id",
        "path_image"
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function comment(): HasMany {
        return $this->hasMany(Comment::class);
    }
}
