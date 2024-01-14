<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Blog;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $blog = Blog::findOrFail($blogId);

        $comment = Comment::create([
            'comment' => $request->input('comment'),
            'user_id' => auth()->user()->id,
            'blog_id' => $blog->id,
        ]);

        return redirect()->route('blogs.show', $blog->id)->with('success', 'Comment added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Comment::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        return redirect()->route('blogs.show', $blogId)->with('success', 'Comment deleted!');
    }
}
