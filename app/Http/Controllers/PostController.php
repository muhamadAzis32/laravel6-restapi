<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::all();

        if (is_null($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Resource not found'
            ], 404);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $data
            ], 200);
        }
    }

    public function show($id)
    {
        $data = Post::find($id);

        if (is_null($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Resource not found'
            ], 404);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $data
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $response = Post::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' =>  $response,
        ], 201);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $post
        ], 200);
    }

    public function destroy( Post $post)
    {
        $post->delete();
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $post
        ], 200);
    }
}
