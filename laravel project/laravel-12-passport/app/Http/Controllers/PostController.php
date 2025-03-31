<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    public function Read(){
    $Read = Post::all();
    return response()->json($Read,201);
    }

    public function updatePost(Request $request, $id)
    {
    //    dd("testing.....");
        $post = Post::find($id);
        if ($post) {
            $post->update($request->all());
            return response()->json($post, 200);
        }
        return response()->json(['message' => 'post not found'], 404);
    }

    public function destroy(Request $request)
    {
        $post = Post::find($request->user_id);
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }


     }


