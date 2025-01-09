<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to add a product to the wishlist.'
            ], 401);
        }
    
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
    
        $userId = auth()->id();  
    
       
        $exists = Wishlist::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->exists();
    
        if ($exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'This product is already in your wishlist.'
            ]);
        }
    
    
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $request->product_id,
        ]);
    
      
        $wishlistCount = auth()->user()->wishlists()->count();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Product added to your wishlist!',
            'wishlist_count' => $wishlistCount,
        ]);
    }
    
    
}

