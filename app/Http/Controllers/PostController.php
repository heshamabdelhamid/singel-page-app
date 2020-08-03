<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('index', compact('posts'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|min:3|max:255',
            'body' => 'required|min:3',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'errors',
                'errors' => $validator->errors()
            ]);
        }

        $post = Post::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $post
        ]);
    }
}
