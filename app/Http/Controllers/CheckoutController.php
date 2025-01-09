<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\CartItem;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Please log in to proceed to checkout.');
    }

    $cartItems = $user->cartItems()->with('product')->get();

    $subtotal = $cartItems->sum(function ($item) {
        return $item->total;
    });

    $shipping = Setting::first()->delivery_charges ?? 0;
    $total = $subtotal + $shipping;

    $userId = Auth::id();

           
      
    $cartItems = CartItem::with('product', 'product.options')  
        ->where('user_id', $userId)
        ->get();

    $cartCount = $cartItems->count();
    $banks=Bank::all();
    $wishlistCount = 0;
    if (Auth::check()) {
        $wishlistCount = Auth::user()->wishlists()->count();
    } 
    return view('userpages.checkout', compact('cartItems', 'subtotal', 'shipping', 'total','user','cartCount','banks','wishlistCount'));
}

    
    
}
