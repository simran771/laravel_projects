<?php

namespace App\Http\Controllers;
use App\Http\Traits\AuthenticationTrait;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\CartItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{

    use AuthenticationTrait;

    
    // public function placeOrder(Request $request)
    // {

    //     $valid = $this->validate_connection_id($request->connection_id);

    //     if(!$valid)
    //         return response()->json(['status'=>'er
    // ror','message'=>'Invalid Connection','data'=>[]]);

    //     $valid_auth = $this->validateAuth($request->connection_id,$request->auth_code);
    //     if(!$valid_auth)
    //         return response()->json(['status'=>'error','message'=>'Unauthenticated!','data'=>[]]);

    //     // Create the order
        
    //     $order = Order::create([
    //         'customer_id' => $request->customer_id,
    //         'payment_method' => $request->payment_method,
    //         'online_payment_method' => $request->payment_method === 'online' ? $request->online_payment_method : 'none',
    //         'total_amount' => $request->total_amount,
    //     ]);

    //     return response()->json([
    //         'message' => 'Order placed successfully!',
    //         'order' => $order
    //     ], 201);
    // }

    public function place_order(Request $request)
    {
        
        $valid_customer = $this->validate_connection_id($request->connection_id);
        if(!$valid_customer)
            return response()->json(['status'=>'error','message'=>'Invalid Connection','data'=>[]]);
        
        $valid_auth = $this->validateAuth($request->connection_id,$request->auth_code);
        if(!$valid_auth)
            return response()->json(['status'=>'error','message'=>'Unauthenticated!','data'=>[]]);

        $payment_method = PaymentMethod::where('method_name', $request->payment_type)->first();

        if(!$payment_method)
        {
            return response()->json([
                "status" => "failed",
                "error" => "Please select valid payment type"
            ]);
        }

        DB::beginTransaction();
        try {
            // Create the order
            // dd("testing...", $payment_method->method_name);
            $order = Order::create([
                'customer_id' => $valid_customer->customer_id,
                'payment_method_id' => $payment_method->id,
                'total_amount' => $request->total_amount,
                'status' => $request->status,
            ]);

            // dd($order);
            // Move items from cart to order_items
            $cartItems = CartItem::where('customer_id', $request->customer_id)->get();
            $totalAmount = 0;


            if($cartItems)
            {
                foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $cartItem->product_name,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                ]);
                $totalAmount += $cartItem->quantity * $cartItem->price;
                }
            }
            

            // Clear cart items
            CartItem::where('customer_id', $request->customer_id)->delete();

            // Create transaction
            Transaction::create([
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'status' => 'pending',
            ]);

            DB::commit();

            return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function cancelOrder(Request $request)
    {
        $order = Order::find($request->id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        $order->update(['status' => $request->status]);
        return response()->json(['message' => 'Order cancelled successfully'], 200);
    }

    public function listOrders(Request $request)
    {
        $valid_customer = $this->validate_connection_id($request->connection_id);
        if(!$valid_customer)
            return response()->json(['status'=>'error','message'=>'Invalid Connection','data'=>[]]);
        
        $valid_auth = $this->validateAuth($request->connection_id,$request->auth_code);
        if(!$valid_auth)
            return response()->json(['status'=>'error','message'=>'Unauthenticated!','data'=>[]]);

        $orders = Order::with('orderItems', 'transaction')->get();
        return response()->json($orders, 200);
    }

    public function orderDetail(Request $request)
    {
        $order = Order::with('orderItems', 'transaction')->find($request->id);
        return $order ? response()->json($order, 200) : response()->json(['message' => 'Order not found'], 404);
    }



}
