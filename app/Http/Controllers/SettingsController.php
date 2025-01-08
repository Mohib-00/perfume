<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\CartItem;
use App\Models\Message;
use App\Models\Policy;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function setting()
    {
     $user = Auth::user();   
     $settings = Setting::all();  
     $count = Message::whereHas('messageStatus', function ($query) {
     $query->where('status', 1);
     })->count();
     return view('adminpages.settings', ['userName' => $user->name, 'count' => $count], compact('settings'));
  }


  public function store(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'image' => 'nullable|image',
          'email' => 'nullable',
          'number' => 'nullable',
          'youtube' => 'nullable',
          'tiktok' => 'nullable',
          'instagram' => 'nullable',
          'facebook' => 'nullable',
          'twitter' => 'nullable',
          'delivery_charges' => 'nullable',
      ]);
  
      if ($validator->fails()) {
          return response()->json(['errors' => $validator->errors()], 422);
      }
  
      $fileName = null; 
  
      if ($request->hasFile('image')) {
          $file = $request->file('image');
          if ($file->isValid()) {
              $uniqueTimestamp = time();
              $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
              $file->move(public_path('images'), $fileName);
          }
      }
  
      $setting = Setting::updateOrCreate(
          [],
          [
              'image' => $fileName,
              'email' => $request->email,
              'number' => $request->number,
              'youtube' => $request->youtube,
              'tiktok' => $request->tiktok,
              'instagram' => $request->instagram,
              'facebook' => $request->facebook,
              'twitter' => $request->twitter,
              'delivery_charges' => $request->delivery_charges,
          ]
      );
  
      return response()->json([
          'success' => true,
          'message' => 'Setting saved successfully!',
          'setting' => $setting
      ], 200);
  }
  
  
  

  public function show($id)
  {
      $setting = Setting::findOrFail($id);
      return response()->json([
          'success' => true,
          'setting' => $setting
      ]);
  }

  public function update(Request $request, $id)
{
    $setting = Setting::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'image' => 'nullable|image',
        'email' => 'nullable|email',
        'number' => 'nullable|numeric',
        'youtube' => 'nullable|url',
        'tiktok' => 'nullable|url',
        'instagram' => 'nullable|url',
        'facebook' => 'nullable|url',
        'twitter' => 'nullable|url',
        'delivery_charges' => 'nullable|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        if ($file->isValid()) {
            $uniqueTimestamp = time();
            $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $setting->image = $fileName;  
        }
    }

    $setting->email = $request->email;
    $setting->number = $request->number;
    $setting->youtube = $request->youtube;
    $setting->tiktok = $request->tiktok;
    $setting->instagram = $request->instagram;
    $setting->facebook = $request->facebook;
    $setting->twitter = $request->twitter;
    $setting->delivery_charges = $request->delivery_charges;

    $setting->save();

    return response()->json([
        'success' => true,
        'message' => 'Setting updated successfully!',
        'setting' => $setting
    ], 200);
}

  

public function deletesetting(Request $request)
{
$setting = Setting::find($request->setting_id);

if ($setting) {
    $setting->delete();
    return response()->json(['success' => true, 'message' => 'setting deleted successfully']);
}

return response()->json(['success' => false, 'message' => 'setting not found']);
}
   

public function changepassword()
{
$user = Auth::user();   
$count = Message::whereHas('messageStatus', function ($query) {
 $query->where('status', 1);
 })->count();
 
 return view('adminpages.profile', ['userName' => $user->name, 'count' => $count]);
}

public function termsofservice()
{
    $user = Auth::check() ? Auth::user() : null;
    $userId = Auth::id();
    $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

    $cartCount = $cartItems->count(); 
    $terms = Policy::where('show_terms', 1)->get();

    return view('userpages.terms', compact('user','cartCount','terms'));
}
public function refundpolicy()
{
    $user = Auth::check() ? Auth::user() : null;
    $userId = Auth::id();
    $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

    $cartCount = $cartItems->count(); 
    $terms = Policy::where('show_refund', 1)->get();

    return view('userpages.refund', compact('user','cartCount','terms'));
}
public function shippingpolicy()
{
    $user = Auth::check() ? Auth::user() : null;
    $userId = Auth::id();
    $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

    $cartCount = $cartItems->count(); 
    $terms = Policy::where('show_shipping', 1)->get();

    return view('userpages.shipping', compact('user','cartCount','terms'));
}
public function privacypolicy()
{
    $user = Auth::check() ? Auth::user() : null;
    $userId = Auth::id();
    $cartItems = CartItem::with('product', 'product.options')  
            ->where('user_id', $userId)
            ->get();

    $cartCount = $cartItems->count(); 
    $terms = Policy::where('show_privacy', 1)->get();

    return view('userpages.privacy', compact('user','cartCount','terms'));
}

public function addpolicies()
{
 $user = Auth::user();   
 $privacies = Policy::all();  
 $count = Message::whereHas('messageStatus', function ($query) {
 $query->where('status', 1);
 })->count();
 return view('adminpages.policy', ['userName' => $user->name, 'count' => $count], compact('privacies'));
}



public function storeprivacy(Request $request)
{
    try {
        $validatedData = $request->validate([
            
            'main_heading' => 'nullable|string|max:255',
            'sub_heading' => 'nullable|string|max:255',
            'paragraph' => 'nullable|string',
            'show_terms' => 'nullable|boolean',
            'show_refund' => 'nullable|boolean',
            'show_shipping' => 'nullable|boolean',
            'show_privacy' => 'nullable|boolean',

        ]);

        $privacy = new Policy();

        $privacy->main_heading = $request->main_heading;
        $privacy->sub_heading = $request->sub_heading;
        $privacy->paragraph = $request->paragraph;

        $privacy->show_terms = $request->input('show_terms', 0) ? 1 : 0;
        $privacy->show_refund = $request->input('show_refund', 0) ? 1 : 0;
        $privacy->show_shipping = $request->input('show_shipping', 0) ? 1 : 0;
        $privacy->show_privacy = $request->input('show_privacy', 0) ? 1 : 0;

        $privacy->save();

        return response()->json(['success' => true, 'privacy' => $privacy]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

public function showprivacy($id)
{
    $privacy = Policy::find($id);

    if ($privacy) {
        return response()->json([
            'success' => true,
            'privacy' => $privacy
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'policy not found'
    ], 404);
}

public function updatePrivacy(Request $request, $id)
{
    try {
        $validatedData = $request->validate([
            'main_heading' => 'nullable|string|max:255',
            'sub_heading' => 'nullable|string|max:255',
            'paragraph' => 'nullable|string',
            'show_terms' => 'nullable|boolean',
            'show_refund' => 'nullable|boolean',
            'show_shipping' => 'nullable|boolean',
            'show_privacy' => 'nullable|boolean',
        ]);

        $privacy = Policy::findOrFail($id);

        $privacy->main_heading = $validatedData['main_heading'];
        $privacy->sub_heading = $validatedData['sub_heading'];
        $privacy->paragraph = $validatedData['paragraph'];
        $privacy->show_terms = $validatedData['show_terms'] ?? 0;
        $privacy->show_refund = $validatedData['show_refund'] ?? 0;
        $privacy->show_shipping = $validatedData['show_shipping'] ?? 0;
        $privacy->show_privacy = $validatedData['show_privacy'] ?? 0;

        $privacy->save();

        return response()->json(['success' => true, 'privacy' => $privacy]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}





public function deleteprivacy(Request $request)
      {
          $privacy = Policy::find($request->privacy_id);
      
          if ($privacy) {
              $privacy->delete();
      
              return response()->json(['success' => true, 'message' => 'Policy deleted successfully']);
          }
      
          return response()->json(['success' => false, 'message' => 'Policy not found']);
      }


      public function addbankdetails()
      {
       $user = Auth::user();   
       $details = Bank::all();  
       $count = Message::whereHas('messageStatus', function ($query) {
       $query->where('status', 1);
       })->count();
       return view('adminpages.bankdetails', ['userName' => $user->name, 'count' => $count], compact('details'));
    }


    public function storedetail(Request $request)
{
    try {
        $validatedData = $request->validate([
            
            'paragraph' => 'nullable',
            'name' => 'nullable',
            'title' => 'nullable',
            'account_number' => 'nullable',
            'iban' => 'nullable',
            'branch_name' => 'nullable',
        ]);

        $detail = new Bank();
        $detail->paragraph = $request->paragraph;
        $detail->name = $request->name;
        $detail->title = $request->title;
        $detail->account_number = $request->account_number;
        $detail->iban = $request->iban;
        $detail->branch_name = $request->branch_name;
        $detail->save();

        return response()->json(['success' => true, 'detail' => $detail]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

public function showdetail($id)
{
    $detail = Bank::find($id);

    if ($detail) {
        return response()->json([
            'success' => true,
            'detail' => $detail
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'policy not found'
    ], 404);
}

public function updatedetail(Request $request, $id)
{
    try {
        $validatedData = $request->validate([
            'paragraph' => 'nullable',
            'name' => 'nullable',
            'title' => 'nullable',
            'account_number' => 'nullable',
            'iban' => 'nullable',
            'branch_name' => 'nullable',
        ]);

        $detail = Bank::findOrFail($id);

        $detail->paragraph = $request->paragraph;
        $detail->name = $request->name;
        $detail->title = $request->title;
        $detail->account_number = $request->account_number;
        $detail->iban = $request->iban;
        $detail->branch_name = $request->branch_name;

        $detail->save();

        return response()->json(['success' => true, 'detail' => $detail]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}





public function deletedetail(Request $request)
      {
          $detail = Bank::find($request->detail_id);
      
          if ($detail) {
              $detail->delete();
      
              return response()->json(['success' => true, 'message' => 'detail deleted successfully']);
          }
      
          return response()->json(['success' => false, 'message' => 'detail not found']);
      }

 
}
