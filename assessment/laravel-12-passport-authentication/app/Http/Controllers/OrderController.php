<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        
        $data = Order::all();
        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
       

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'status' => $request->status,
            'product name' => $request->product_name,
            'total_amount' => $request->total_amount,
        ]);
    
        return response()->json([
            'message' => 'Order inserted successfully',
            'data' => $order
        ], 201);

}
}
