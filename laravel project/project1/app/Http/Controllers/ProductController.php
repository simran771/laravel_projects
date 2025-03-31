<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return product::all(); // for finding all data
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'title' => 'required|string',
        //     'content' => 'required|string',
        // ]);
        $payload = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'sku' => $request->sku,
            'category' => $request->category,
            'is_active' => $request->is_active,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        

        // return product::create($request->all());
        // return product::insert($payload);
        return product::insertGetId($payload);

             // to create new data
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Post::findOrFail($id); // to find an specific data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return $post;// for update a data
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Deleted successfully']);
    } // for deletes
    
}
