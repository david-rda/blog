<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";

    protected $primaryKey = "id";

    protected $fillable = [
        "blog_id",
        "user_id",
        "comment",
    ];

    public $timestamps = true;

    public function blog() {
        return $this->belongsTo(Blog::class, "id", "blog_id");
    }
}
