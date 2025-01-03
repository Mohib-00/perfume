<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'payment' => 'required'
        ]);
    
        DB::beginTransaction();
    
        try {
             $customer = Customer::updateOrCreate(
                ['email' => $request->input('email')],
                [
                    'first_name' => $request->input('full_name'),
                    'last_name' => $request->input('last_name'),
                    'province' => $request->input('province'),
                    'phone_number' => $request->input('phone_number'),
                    'address' => $request->input('address'),
                    'city' => $request->input('city')
                ]
            );
    
             $cartItems = CartItem::where('user_id', auth()->id())
                ->with('product', 'option')  
                ->get();
    
             if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Your cart is empty'], 400);
            }
    
             $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            $shippingPrice = Setting::first()->delivery_charges ?? 10;
            $total = $subtotal + $shippingPrice;
    
             $order = Order::create([
                'customer_id' => $customer->id,
                'total' => $total,
                'status' => 'pending',
                'payment_type' => $request->input('payment')
            ]);
    
             foreach ($cartItems as $item) {
                 $optionId = $item->option ? $item->option->id : null;
    
                 \Log::info("Processing Cart Item: Product ID = {$item->product->id}, Option ID = {$optionId}");
    
                 if ($optionId) {
                    $option = Option::find($optionId);
    
                     if (!$option) {
                        \Log::error("Invalid Option ID: {$optionId} for Product ID = {$item->product->id}");
                        return response()->json(['error' => 'Invalid option selected for a product'], 400);
                    }
    
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'subtotal' => $item->product->price * $item->quantity,
                        'option_id' => $optionId,  
                    ]);
                } else {
                     OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'subtotal' => $item->product->price * $item->quantity,
                        'option_id' => null,  
                    ]);
                }
    
                 $product = $item->product;
                $product->quantity -= $item->quantity;
                $product->save();
            }
    
             CartItem::where('user_id', auth()->id())->delete();
    
             DB::commit();
    
             return response()->json(['message' => 'Order placed successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to place order: '.$e->getMessage());
            return response()->json(['error' => 'Failed to place order', 'details' => $e->getMessage()], 500);
        }
    }
    
    
    
    
    

    public function  order(){ 
        $orders = Order::with('customer')->get();
        return view('order',compact('orders'));
     }

     public function orderview($order_id)
     {
         
         $orderItems = OrderItem::where('order_id', $order_id)
             ->with('product')  
             ->get();
     
         return view('orderview', [
             'orderItems' => $orderItems
         ]);
     }

  
public function confirmDelivery(Request $request)
{
   
    $request->validate([
        'order_id' => 'required|exists:orders,id',
    ]);

     
    $order = Order::find($request->order_id);

    
    $order->status = 'completed';
    $order->save();

   
    return response()->json(['success' => true, 'message' => 'Order status updated to completed.']);
}

public function destroy(Request $request)
{
    $orderId = $request->input('order_id');

     
    $order = Order::find($orderId);

    if ($order) {
        $order->delete();
        return response()->json(['success' => true, 'message' => 'Order deleted successfully.']);
    }

    return response()->json(['success' => false, 'message' => 'Order not found.']);
}

}
