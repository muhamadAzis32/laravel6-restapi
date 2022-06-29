<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::all();
        return new PostCollection($data);

        // TODO: Resource Collection
        // return response()->json([
        //     'status' => true,
        //     'message' => 'Success',
        //     'data' => $data
        // ], 200);
    }

    public function show($id)
    {
        $data = Post::find($id);

        if (is_null($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        return new PostResource($data);

        // TODO: tanpa custom response
        // return response()->json([
        //     'status' => true,
        //     'message' => 'Success',
        //     'data' => $data
        // ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'min:5']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

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

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $post
        ], 200);
    }
}
