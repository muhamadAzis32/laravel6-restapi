<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::all();
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = Post::find($id);
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $response = Post::create($data);
        return response()->json([
            201,
            'success',
            $response
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return response()->json([
            200,
            'success updated',
            $post,
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            200,
            'success deleted'
        ]);
    }
}
