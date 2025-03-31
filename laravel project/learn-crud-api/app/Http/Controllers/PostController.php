<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function getPosts(){
        // dd("testing....");
        $posts = Post::all();
        return response()->json($posts, 200);
    }
    
    public function createPost(Request $request){

        // dd($request);
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }


        public function deletePosts($id)
        {

            // dd("testing....");
            $post = Post::find($id);
            if ($post) {
                $post->delete();
                return response()->json(['message' => 'post deleted'], 200);
            }
            return response()->json(['message' => 'post not found'], 404);
        }

        public function updatePost(Request $request, $id)
        {
           // dd("testing.....");
            $post = post::find($id);
            if ($post) {
                $post->update($request->all());
                return response()->json($post, 200);
            }
            return response()->json(['message' => 'User not found'], 404);
        }

    
}
