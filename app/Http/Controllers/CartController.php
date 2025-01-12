<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'option_id' => 'nullable|exists:options,id',
            'quantity' => 'nullable|integer|min:1',
        ]);
    
        $userId = Auth::id();
    
        if (!$userId) {
            return response()->json(['message' => 'User not logged in.'], 401);
        }
    
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;
    
         $price = $product->discount_price ?? $product->price;
        $total = $price * $quantity;
    
         $cartItem = CartItem::where('product_id', $request->product_id)
            ->where('user_id', $userId)
            ->where('option_id', $request->option_id)
            ->first();
    
        if ($cartItem) {
             $cartItem->quantity += $quantity;
            $cartItem->total = $cartItem->quantity * $price;
            $cartItem->save();
        } else {
             CartItem::create([
                'product_id' => $request->product_id,
                'option_id' => $request->option_id,
                'quantity' => $quantity,
                'total' => $total,
                'user_id' => $userId,
            ]);
        }
        return response()->json(['message' => 'Product added to cart successfully.']);
    }

    public function cart(){
        $user = Auth::check() ? Auth::user() : null;
        $userId = Auth::id();
    
        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

        $cartCount = $cartItems->count(); 
        $subtotal = $cartItems->sum('total');   
        $deliveryCharges =Setting::first()->delivery_charges;
        $wishlistCount = 0;
        if (Auth::check()) {
            $wishlistCount = Auth::user()->wishlists()->count();
        } 
        return view('userpages.cart', compact('user','cartItems', 'cartCount','subtotal','deliveryCharges','wishlistCount'));
    }
    

    public function update(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
         $cartItem = CartItem::findOrFail($request->cart_item_id);
        $cartItem->quantity = $request->quantity;
    
         $price = $cartItem->product->discount_price ?? $cartItem->product->price;
    
         $cartItem->total = $cartItem->quantity * $price;
        $cartItem->save();
    
         $subtotal = CartItem::where('user_id', Auth::id())->sum('total');  
    
         $deliveryCharges = Setting::first()->delivery_charges;  
    
         $totalPrice = $subtotal + $deliveryCharges;
    
         return response()->json([
            'newQuantity' => $cartItem->quantity,
            'newTotal' => number_format($cartItem->total),  
            'newSubtotal' => number_format($subtotal),  
            'newTotalPrice' => number_format($totalPrice), 
        ]);
    }

    public function removeCartItem($id)
    {
        $user = Auth::user();
    
        $cartItem = CartItem::where('id', $id)->where('user_id', $user->id)->first();
    
        if ($cartItem) {
            $cartItem->delete();
    
             $subtotal = CartItem::where('user_id', $user->id)->sum('total');
    
             $deliveryCharges = Setting::first()->delivery_charges ?? 0;
    
             $totalPrice = $subtotal + $deliveryCharges;
    
             $cartEmpty = CartItem::where('user_id', $user->id)->count() == 0;
    
            return response()->json([
                'status' => 'success',
                'newSubtotal' => number_format($subtotal),    
                'rawSubtotal' => $subtotal,                    
                'newTotalPrice' => number_format($totalPrice), 
                'rawTotalPrice' => $totalPrice,               
                'cartEmpty' => $cartEmpty,                     
            ]);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'Cart item not found.'
        ]);
    }
    

    
    
}
