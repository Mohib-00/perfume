<?php

namespace App\Http\Controllers;

use App\Models\Message;
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
            'delivery_charges' => 'nullable|string|max:255',
       ]);
  
      if ($validator->fails()) {
          return response()->json(['errors' => $validator->errors()], 422);
      }
       
  
      $setting = Setting::create([
           'delivery_charges' => $request->delivery_charges,
      ]);
  
      return response()->json([
          'success' => true,
          'message' => 'Setting added successfully!',
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
          'delivery_charges' => 'nullable|numeric',  
      ]);
  
      if ($validator->fails()) {
          return response()->json(['errors' => $validator->errors()], 422);
      }
  
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

}
