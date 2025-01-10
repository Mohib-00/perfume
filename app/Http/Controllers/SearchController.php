<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        
        if (!$query) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }
    
        $products = Product::where('name', 'LIKE', "%$query%")
        ->orWhere('description', 'LIKE', "%$query%")
        ->with(['feedbacks' => function ($query) {
            $query->select('product_id', DB::raw('AVG(rating) as average_rating'))
                  ->groupBy('product_id');
        }])
        ->get();
    
        $products->each(function ($product) {
           $product->average_rating = $product->feedbacks->first()->average_rating ?? 0;
        });
    
    
        $pages = [
            'women fragrance' => route('womens.fragrances'),
            'men fragrance' => route('mens.fragrances'),
            'travel size' => route('travel.size'),
            'discovery' => route('discovery'),
            'collection' => route('view.collection'),
            'blog' => route('blog'),
            'contact' => route('contact'),
            'sale' => route('sale'),
        ];
    
      
        foreach ($pages as $key => $url) {
            if (stripos($query, $key) !== false) {
                return redirect($url);
            }
        }
        $user = Auth::check() ? Auth::user() : null;
        $userId = Auth::id();
        $cartItems = CartItem::with('product', 'product.options')  
        ->where('user_id', $userId)
        ->get();

        $cartCount = $cartItems->count(); 

        return view('userpages.searchresults', [
            'selectionProducts' => $products,
            'query' => $query,
        ],compact('user','cartCount'));
    }
    
}
