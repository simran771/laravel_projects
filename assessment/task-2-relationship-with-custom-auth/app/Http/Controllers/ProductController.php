<?php

namespace App\Http\Controllers;
use App\Http\Traits\AuthenticationTrait;
use Illuminate\Http\Request;
use App\Models\Product;

use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{

    use AuthenticationTrait;
    public function indexproduct()
    
    {
        // dd('sahgd');
        $data = product::all();
        return response()->json($data, 200);
}


    public function store(Request $request)
    {
        //dd('sjfhbkldc');
       

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'stock_quantity' => $request->stock_quantity,
            'image_url' => $request->image_url,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'product inserted successfully',
            'data' => $product
        ], 201);
    }

    public function listProducts(Request $request)
    {
        $valid_customer = $this->validate_connection_id($request->connection_id);
        if(!$valid_customer)
            return response()->json(['status'=>'error','message'=>'Invalid Connection','data'=>[]]);
        
        $valid_auth = $this->validateAuth($request->connection_id,$request->auth_code);
        if(!$valid_auth)
            return response()->json(['status'=>'error','message'=>'Unauthenticated!','data'=>[]]);
        $products = Product::all();
        return response()->json($products);
    }

    public function getProductDetail(Request $request)
    {
         $valid_customer = $this->validate_connection_id($request->connection_id);
        if(!$valid_customer)
            return response()->json(['status'=>'error','message'=>'Invalid Connection','data'=>[]]);
        
        $valid_auth = $this->validateAuth($request->connection_id,$request->auth_code);
        if(!$valid_auth)
            return response()->json(['status'=>'error','message'=>'Unauthenticated!','data'=>[]]);
        
        $product = Product::find($request->id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }



}