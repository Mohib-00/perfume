<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
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
    
    
}
