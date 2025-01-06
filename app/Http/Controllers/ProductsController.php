<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function  addproducts(){ 
        $user = Auth::user();
        $products = Product::all();
        $count = Message::whereHas('messageStatus', function ($query) {
            $query->where('status', 1);
            })->count();
        return view('adminpages.products', ['userName' => $user->name, 'count' => $count],compact('products'));
      }


      public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'image' => 'nullable|file|image|max:2048',
            'hover_image' => 'nullable|file|image|max:2048',
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'discount_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'slug' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'show_sale_product' => 'nullable|boolean',
            'show_favourite_product' => 'nullable|boolean',
            'show_selection_product' => 'nullable|boolean',
            'showon_women_page' => 'nullable|boolean',
            'showon_men_page' => 'nullable|boolean',
            'showon_discovery_page' => 'nullable|boolean',
            'showon_sale_page' => 'nullable|boolean',
            'showon_collection_page' => 'nullable|boolean',
            'showon_explore_page' => 'nullable|boolean',
        ]);

        $product = new Product();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $uniqueTimestamp = time();
                $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $fileName);
                $product->image = $fileName;
            }
        }

        if ($request->hasFile('hover_image')) {
            $file = $request->file('hover_image');
            if ($file->isValid()) {
                $uniqueTimestamp = time();
                $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $fileName);
                $product->hover_image = $fileName;
            }
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->description = $request->description;
        $product->slug = $request->slug;
        $product->quantity = $request->quantity;
        $product->show_sale_product = $request->input('show_sale_product', 0) ? 1 : 0;
        $product->show_favourite_product = $request->input('show_favourite_product', 0) ? 1 : 0;
        $product->show_selection_product = $request->input('show_selection_product', 0) ? 1 : 0;
        $product->showon_women_page = $request->input('showon_women_page', 0) ? 1 : 0;
        $product->showon_men_page = $request->input('showon_men_page', 0) ? 1 : 0;
        $product->showon_discovery_page = $request->input('showon_discovery_page', 0) ? 1 : 0;
        $product->showon_sale_page = $request->input('showon_sale_page', 0) ? 1 : 0;
        $product->showon_collection_page = $request->input('showon_collection_page', 0) ? 1 : 0;
        $product->showon_explore_page = $request->input('showon_explore_page', 0) ? 1 : 0;

        $product->save();

        return response()->json(['success' => true, 'product' => $product]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

public function show($id)
{
    $product = Product::find($id);

    if ($product) {
        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Product not found'
    ], 404);
}

public function update(Request $request, $id)
{
    try {
        $validatedData = $request->validate([
            'image' => 'nullable|file|image|max:2048',
            'hover_image' => 'nullable|file|image|max:2048',
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'discount_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'slug' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'show_sale_product' => 'nullable|boolean',
            'show_favourite_product' => 'nullable|boolean',
            'show_selection_product' => 'nullable|boolean',
            'showon_women_page' => 'nullable|boolean',
            'showon_men_page' => 'nullable|boolean',
            'showon_discovery_page' => 'nullable|boolean',
            'showon_sale_page' => 'nullable|boolean',
            'showon_collection_page' => 'nullable|boolean',
            'showon_explore_page' => 'nullable|boolean',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $uniqueTimestamp = time();
                $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $fileName);
                $product->image = $fileName;
            }
        }

        if ($request->hasFile('hover_image')) {
            $file = $request->file('hover_image');
            if ($file->isValid()) {
                $uniqueTimestamp = time();
                $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $fileName);
                $product->hover_image = $fileName;
            }
        }

        $product->name = $request->name ?? $product->name;
        $product->price = $request->price ?? $product->price;
        $product->discount_price = $request->discount_price ?? $product->discount_price;
        $product->description = $request->description ?? $product->description;
        $product->slug = $request->slug ?? $product->slug;
        $product->quantity = $request->quantity ?? $product->quantity;

        $product->show_sale_product = $request->input('show_sale_product', 0) ? 1 : 0;
        $product->show_favourite_product = $request->input('show_favourite_product', 0) ? 1 : 0;
        $product->show_selection_product = $request->input('show_selection_product', 0) ? 1 : 0;
        $product->showon_women_page = $request->input('showon_women_page', 0) ? 1 : 0;
        $product->showon_men_page = $request->input('showon_men_page', 0) ? 1 : 0;
        $product->showon_discovery_page = $request->input('showon_discovery_page', 0) ? 1 : 0;
        $product->showon_sale_page = $request->input('showon_sale_page', 0) ? 1 : 0;
        $product->showon_collection_page = $request->input('showon_collection_page', 0) ? 1 : 0;
        $product->showon_explore_page = $request->input('showon_explore_page', 0) ? 1 : 0;

        $product->save();

        return response()->json(['success' => true, 'product' => $product]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}



public function deleteproduct(Request $request)
      {
          $product = Product::find($request->product_id);
      
          if ($product) {
              $product->delete();
      
              return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
          }
      
          return response()->json(['success' => false, 'message' => 'Product not found']);
      }
      public function exploreProduct($slug)
      {
          $user = Auth::user();
          $product = Product::where('slug', $slug)->firstOrFail();
          
           $relatedProducts = Product::where('slug', $slug)->where('id', '!=', $product->id)->get();
      
           foreach ($relatedProducts as $relatedProduct) {
              $relatedProduct->average_rating = $relatedProduct->averageRating();
          }
          
          if (request()->ajax()) {
              return response()->json([
                  'success' => true,
                  'redirect_url' => route('single.product.page', ['slug' => $slug]),
              ]);
          }
      
          $userId = Auth::id();
          $cartItems = CartItem::with('product', 'product.options')
              ->where('user_id', $userId)
              ->get();
          $cartCount = $cartItems->count();
          
          return view('userpages.showexplore', compact('product', 'user', 'relatedProducts', 'cartCount', 'cartItems', 'product'));
      }
      
      

      

      

 
    }

