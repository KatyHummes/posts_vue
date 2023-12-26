<?php

namespace App\Http\Controllers;

use App\Http\Requests\postRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function create()
    {
       return Inertia::render('CreatePost');
    }

    public function store(PostRequest $request)
    {
        dd($request->all());
        $filePath = null;
        $fileName = null;


        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('public/images');
            $filePath = str_replace('public/', '', $filePath);

        }
        // dd($request->all());
        Post::create([
            'title' => $request->input('title'),
            'image_path' => $filePath,
            'image_name' => $fileName,
            'user_id' => auth()->user()->id
        ]);

    }
}
