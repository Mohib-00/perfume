<?php

namespace App\Http\Controllers;

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
 
     
    public function home(){ 
        $user = Auth::check() ? Auth::user() : null;
         return view('userpages.home', compact('user'));
     }
 
     public function admin(){ 
        $user = Auth::user(); 
         return view('adminpages.admin',['userName' => $user->name]);
     }
 
     public function  users(){ 
        $user = Auth::user();
        $users = User::all();
        return view('adminpages.users', ['userName' => $user->name],compact('users'));
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
          return view('userpages.aboutus', compact('user'));
      }

      public function sale()
      {
        $user = Auth::check() ? Auth::user() : null;
          return view('userpages.sale', compact('user'));
      }

      public function contactus()
      {
        $user = Auth::check() ? Auth::user() : null;
          return view('userpages.contact', compact('user'));
      }

      public function womensfragrances()
      {
        $user = Auth::check() ? Auth::user() : null;
          return view('userpages.womensfragrance', compact('user'));
      }


      public function mensfragrances()
      {
        $user = Auth::check() ? Auth::user() : null;
          return view('userpages.mensfragrance', compact('user'));
      }


      public function travelsize()
      {
        $user = Auth::check() ? Auth::user() : null;
          return view('userpages.travel', compact('user'));
      }


      public function discovery()
      {
        $user = Auth::check() ? Auth::user() : null;
          return view('userpages.discover', compact('user'));
      }


      public function collections()
      {
        $user = Auth::check() ? Auth::user() : null;
          return view('userpages.collection', compact('user'));
      }
     
      public function blogs()
      {
        $user = Auth::check() ? Auth::user() : null;
          return view('userpages.blogs', compact('user'));
      }

      public function details()
      {
        $user = Auth::check() ? Auth::user() : null;
          return view('userpages.productdetails', compact('user'));
      }
}