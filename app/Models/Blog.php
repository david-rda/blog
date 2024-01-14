<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Blog extends Model
{
    use HasFactory;

    protected $table = "blogs";

    protected $primaryKey = "id";

    protected $fillable = [
        "user_id",
        "title",
        "description",
        "image",
    ];

    protected $appends = [
        "comments"
    ];

    protected $hidden = [
        "comment"
    ];

    public $timestamps = true;

    public function comment() {
        return $this->hasMany(Comment::class, "blog_id", "id");
    }

    public function getCommentsAttribute() {
        return $this->comment;
    }
}