<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
class CustomerController extends Controller
{
    public function index()
    
    {
        // dd('sahgd');
        $data = customer::all();
        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
       

        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return response()->json([
            'message' => 'Customer inserted successfully',
            'data' => $customer
        ], 201);
    }

    public function showCustomers()
    {
        // Fetch all customers with orders
        $customers = Customer::with('orders')->get();

        // Transform data to get total orders, first order, and last order
        $customers = $customers->map(function ($customer) {
            return [
                'name' => $customer->name,
                'phone_number' => $customer->phone,
                'total_orders' => $customer->orders->count(),
                'first_order_date' => $customer->orders->first()?->created_at,
                'last_order_date' => $customer->orders->last()?->created_at,
            ];
        });

        return response()->json($customers);
    }
    
}
