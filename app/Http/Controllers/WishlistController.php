<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    
    public function wishlist()
    {
        $user = Auth::check() ? Auth::user() : null;
    
        // Fetch products shown on discovery page
        $discoveryselections = Product::where('showon_discovery_page', 1)
            ->with(['options', 'reviews'])
            ->get();
    
        // Calculate average rating for each discovery product
        $discoveryselections->each(function ($product) {
            $product->average_rating = round($product->reviews->avg('rating'), 1);
        });
    
        $userId = Auth::id();
    
        // Fetch cart items for the current user
        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();
    
        $cartCount = $cartItems->count(); 
    
        // Initialize wishlist count and items
        $wishlistCount = 0;
        $wishlistItems = [];
    
        // If the user is authenticated, fetch the wishlist items
        if (Auth::check()) {
            $wishlistCount = Auth::user()->wishlists()->count();
            $wishlistItems = Auth::user()->wishlists()->with('product.reviews')->get();
    
            // Calculate the average rating for each wishlist product
            $wishlistItems->each(function ($wishlistItem) {
                $wishlistItem->product->average_rating = round($wishlistItem->product->reviews->avg('rating'), 1);
            });
        }
    
        // Fetch carousel data, if available
        $carousels = Carousel::first() ?? new Carousel([
            'name' => '',
            'image' => '',
        ]);
    
        // Fetch selection products
        $selectionProducts = Product::where('show_selection_product', 1)
            ->with(['options', 'reviews'])
            ->get();
    
        // Calculate the average rating for each selection product
        $selectionProducts->each(function ($product) {
            $product->average_rating = round($product->reviews->avg('rating'), 1);
        });
    
        // Check if wishlist is empty
        $noItemsInWishlist = $wishlistItems->isEmpty();
    
        if (request()->ajax()) {
            return response()->json([
                'wishlistItems' => $wishlistItems,
                'noItemsInWishlist' => $noItemsInWishlist,
            ]);
        }
    
        // Return view for normal request
        return view('userpages.wishlist', compact(
            'user', 
            'discoveryselections', 
            'selectionProducts', 
            'cartCount', 
            'cartItems', 
            'wishlistCount', 
            'carousels', 
            'wishlistItems',
            'noItemsInWishlist' 
        ));
    }
    
    
    
}

