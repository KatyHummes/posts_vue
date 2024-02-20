<?php

namespace App\Http\Controllers;

use App\Http\Requests\postRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Storage;

class PostController extends Controller
{
    public function create()
    {
        return Inertia::render('CreatePost');
    }

    public function store(PostRequest $request)
    {
        // dd($request->all());
        $filePath = null;
        $fileName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('public/images');
            $filePath = str_replace('public/', '', $filePath);
        }
        // dd($request->all());
        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'image_path' => $filePath,
            'image_name' => $fileName,
        ]);
    }

    public function update(PostRequest $request, $id)
    {
        // dd($request->all(), $id);
        $filePath = null;
        $fileName = null;

        $post = Post::findOrFail($id);

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('public/images');
            $filePath = str_replace('public/', '', $filePath);

            // Storage::delete('public/images/' . $post->image_path);
        } else {
            $filePath = $post->image_path;
            $fileName = $post->image_name;
        }

        $post->update([
            'title' => $request->input('title'),
            'image_path' => $filePath,
            'image_name' => $fileName,
        ]);
    }


    public function destroy(Post $post)
    {
        $post->delete();
    }
}
