<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Auth;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $imagePath = $request->file('image')->store('blog_images', 'public');

        $blog = Blog::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            // 'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['success' => 'Blog created successfully!']);
    }

    public function show($id)
    {
        return Blog::findOrFail($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $blog = Blog::findOrFail($id);

        $blog->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['success' => 'Blog Updated!']);
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id)->delete();
        
        return response()->json(['success' => 'Blog deleted!']);
    }
}
