<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getcustomer(){
        // dd("testing....");
        $posts = Post::all();
        return response()->json($posts, 200);
}
}