<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\CartItem;
use App\Models\Message;
use App\Models\Product;
use App\Models\SectionDetail;
use App\Models\ShowcaseImage;
use App\Models\Story;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserAuthcontroller extends Controller
{
    public function register(Request $request) {
        try {
            
            $validateuser = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'confirmPassword' => 'required|same:password',  
            ]);
    
            
            if ($validateuser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateuser->errors()  
                ], 401);  
            }
    
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),  
            ]);
    
            
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken  
            ], 200);
    
        } catch (\Throwable $th) {
           
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    
 
 
     public function login(Request $request)
{
    try {
      
        $validateuser = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

       
        if ($validateuser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validateuser->errors(),
            ], 422); 
        }

        
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'The credentials do not match our record.',
                'errors' => [
                    'password' => ['The password you entered is incorrect.']
                ],
            ], 401); 
        }
 
        $user = Auth::user();

        return response()->json([
            'status' => true,
            'message' => 'User logged in successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'userType' => $user->userType,
        ], 200);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage(),
        ], 500);
    }
}

public function changePassword(Request $request){
    $request->validate([
        'password' => 'required|confirmed',
    ]);
    $loggeduser = auth()->user();
    $loggeduser->password = Hash::make($request->password);
    $loggeduser->save();
    return response()->json([
        'message' => 'Password change succesfully',
        'status' => 'Success'   
    ], 200);
}


public function logout() {
       
    auth()->user()->tokens()->delete();

    Session::flush(); 

    return response()->json([
        'status' => true,
        'message' => 'User logged out',
        'data' => [],
    ], 200);
}

     public function logoutuser() {
       
        auth()->user()->tokens()->delete();
 
        Session::flush(); 
    
        return response()->json([
            'status' => true,
            'message' => 'User logged out',
            'data' => [],
        ], 200);
    }
 
     
    public function home()
    {
        
        $user = Auth::check() ? Auth::user() : null;
    
       
        $favouriteProducts = Product::where('show_favourite_product', 1)->get();
        $saleProducts = Product::where('show_sale_product', 1)
            ->with(['options', 'reviews'])  
            ->get();
            $saleProducts->each(function ($product) {
                $product->average_rating = round($product->reviews->avg('rating'), 1);
            });

        $selectionProducts = Product::where('show_selection_product', 1)
        ->with(['options', 'reviews'])
        ->get();
        $selectionProducts->each(function ($product) {
            $product->average_rating = round($product->reviews->avg('rating'), 1);
        });

        $showcaseimages = ShowcaseImage::all();
        $carousels = Carousel::first() ?? new Carousel([
            'name' => '',
            'image' => '',
        ]);
        $openings = SectionDetail::all();
        $stories = Story::all();
        $userId = Auth::id();
    
        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

        $cartCount = $cartItems->count(); 

        $reviews = \DB::table('feedbacks')
        ->join('products', 'feedbacks.product_id', '=', 'products.id')
        ->select('feedbacks.*', 'products.name as product_name')
        ->get();
    
        return view('userpages.home', compact('user', 'favouriteProducts','saleProducts','selectionProducts','showcaseimages','carousels','openings','stories','cartCount','cartItems','reviews'));
    }
    

 
     public function admin(){ 
        $user = Auth::user(); 
        $count = Message::whereHas('messageStatus', function ($query) {
            $query->where('status', 1);
            })->count();
         return view('adminpages.admin',['userName' => $user->name, 'count' => $count]);
     }
 
     public function  users(){ 
        $user = Auth::user();
        $users = User::all();
        $count = Message::whereHas('messageStatus', function ($query) {
            $query->where('status', 1);
            })->count();
        return view('adminpages.users', ['userName' => $user->name, 'count' => $count],compact('users'));
      }


      public function getUserData(Request $request)
      {
          $userId = $request->input('user_id');
          $user = User::find($userId);
          $currentUser = Auth::user();  
      
          if ($user) {
              return response()->json([
                  'success' => true,
                  'user' => $user,
                  'currentUser' => $currentUser
              ]);
          }
      
          return response()->json(['success' => false, 'message' => 'User not found']);
      }
      
      public function editUser(Request $request, $id)
      {
          
      
          $user = User::findOrFail($id);
      
          $user->name = $request->name;
          $user->email = $request->email;
      
          if ($request->filled('password')) {
              $user->password = Hash::make($request->password);
          }
      
          $user->userType = $request->userType;
      
          $user->save();
      
          return response()->json(['message' => 'User updated successfully.']);
      }
      
      public function deleteUser(Request $request)
      {
          $user = User::find($request->user_id);
      
          if ($user) {
              $user->delete();
      
              return response()->json(['success' => true, 'message' => 'User deleted successfully']);
          }
      
          return response()->json(['success' => false, 'message' => 'User not found']);
      }


      public function aboutUs()
      {
        $user = Auth::check() ? Auth::user() : null;
        $stories = Story::all();
        $userId = Auth::id();

         
        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

        $cartCount = $cartItems->count(); 
        return view('userpages.aboutus', compact('user','stories','cartCount','cartItems'));
      }

      public function sale()
      {
        $user = Auth::check() ? Auth::user() : null;
        $saleselections = Product::where('showon_sale_page', 1)
        ->with(['options', 'reviews'])
        ->get();
        $saleselections->each(function ($product) {
            $product->average_rating = round($product->reviews->avg('rating'), 1);
        });
        $userId = Auth::id();

         
    
        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

        $cartCount = $cartItems->count(); 
        return view('userpages.sale', compact('user','saleselections','cartCount','cartItems'));
      }

      public function contactus()
      {
        $userId = Auth::id();

         
    
        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

        $cartCount = $cartItems->count(); 
        $user = Auth::check() ? Auth::user() : null;
          return view('userpages.contact', compact('user','cartCount','cartItems'));
      }

      public function womensfragrances()
      {
        $user = Auth::check() ? Auth::user() : null;
        $womenselections = Product::where('showon_women_page', 1)
        ->with(['options', 'reviews'])
        ->get();
        $womenselections->each(function ($product) {
            $product->average_rating = round($product->reviews->avg('rating'), 1);
        });
        $userId = Auth::id();

        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

        $cartCount = $cartItems->count(); 
        return view('userpages.womensfragrance', compact('user','womenselections','cartCount','cartItems'));
      }


      public function mensfragrances()
      {
        $user = Auth::check() ? Auth::user() : null;
        $menselections = Product::where('showon_men_page', 1)
        ->with(['options', 'reviews'])
        ->get();
        $menselections->each(function ($product) {
            $product->average_rating = round($product->reviews->avg('rating'), 1);
        });
        $userId = Auth::id();

        
    
        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

        $cartCount = $cartItems->count(); 
        return view('userpages.mensfragrance', compact('user','menselections','cartCount','cartItems'));
      }


      public function travelsize()
      {
        $user = Auth::check() ? Auth::user() : null;
        $travelselections = Product::where('showon_explore_page', 1)
        ->with(['options', 'reviews'])
        ->get();
        $travelselections->each(function ($product) {
            $product->average_rating = round($product->reviews->avg('rating'), 1);
        });
        $userId = Auth::id();

        
        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

        $cartCount = $cartItems->count(); 
        return view('userpages.travel', compact('user','travelselections','cartCount','cartItems'));
      }


      public function discovery()
      {
        $user = Auth::check() ? Auth::user() : null;
        $discoveryselections = Product::where('showon_discovery_page', 1)
        ->with(['options', 'reviews'])
        ->get();
        $discoveryselections->each(function ($product) {
            $product->average_rating = round($product->reviews->avg('rating'), 1);
        });
        $userId = Auth::id();

         
        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

        $cartCount = $cartItems->count(); 
        return view('userpages.discover', compact('user','discoveryselections','cartCount','cartItems'));
      }


      public function collections()
      {
        $user = Auth::check() ? Auth::user() : null;
        $collectionselections = Product::where('showon_collection_page', 1)
        ->with(['options', 'reviews'])
        ->get();
        $collectionselections->each(function ($product) {
            $product->average_rating = round($product->reviews->avg('rating'), 1);
        });
        $userId = Auth::id();

         
    
        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

        $cartCount = $cartItems->count(); 
        return view('userpages.collection', compact('user','collectionselections','cartCount','cartItems'));
      }
     
      public function blogs()
      {
        $user = Auth::check() ? Auth::user() : null;
        $userId = Auth::id();

         
    
        $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

        $cartCount = $cartItems->count(); 
        return view('userpages.blogs', compact('user','cartCount','cartItems'));
      }

      public function details($productName)
{
    $user = Auth::check() ? Auth::user() : null;
    $product = Product::with('options', 'reviews')->where('name', $productName)->firstOrFail();

    $averageRating = $product->reviews()->avg('rating');
    $averageRating = round($averageRating, 1); 

    $userId = Auth::id();
    $cartItems = CartItem::with('product', 'product.options')  
        ->where('user_id', $userId)
        ->get();
    $cartCount = $cartItems->count();

    return view('userpages.productdetails', compact('user', 'product', 'cartCount', 'cartItems', 'averageRating'));
}

      
}
