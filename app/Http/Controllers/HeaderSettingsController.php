<?php

namespace App\Http\Controllers;

use App\Models\HeaderSettings;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HeaderSettingsController extends Controller
{
    public function  headersettings(){ 
        $user = Auth::user();
        $headers = HeaderSettings::all();
        $count = Message::whereHas('messageStatus', function ($query) {
            $query->where('status', 1);
            })->count();
        return view('adminpages.headersettings', ['userName' => $user->name, 'count' => $count],compact('headers'));
      }

      public function store(Request $request)
      {
          $validator = Validator::make($request->all(), [
              'image' => 'nullable',
              'heading1' => 'nullable|string|max:255',
              'heading2' => 'nullable|string|max:255',
              'heading3' => 'nullable|string|max:255',
              'heading4' => 'nullable|string|max:255',
              'heading5' => 'nullable|string|max:255',
          ]);
      
          if ($validator->fails()) {
              return response()->json(['errors' => $validator->errors()], 422);
          }
      
          $header = HeaderSettings::first(); 
      
          if ($request->hasFile('image')) {
              $file = $request->file('image');
              if ($file->isValid()) {
                  $uniqueTimestamp = time();
                  $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                  $file->move(public_path('images'), $fileName);
                  $imagePath = $fileName;
              }
          }
      
          if ($header) {
              $header->update([
                  'image' => isset($fileName) ? $fileName : $header->image,
                  'heading1' => $request->heading1,
                  'heading2' => $request->heading2,
                  'heading3' => $request->heading3,
                  'heading4' => $request->heading4,
                  'heading5' => $request->heading5,
              ]);
          } else {
              $header = HeaderSettings::create([
                  'image' => isset($fileName) ? $fileName : null,
                  'heading1' => $request->heading1,
                  'heading2' => $request->heading2,
                  'heading3' => $request->heading3,
                  'heading4' => $request->heading4,
                  'heading5' => $request->heading5,
              ]);
          }
      
          return response()->json([
              'success' => true,
              'message' => 'Header saved successfully!',
              'header' => $header
          ], 200);
      }
      
      
      

      public function show($id)
      {
          $header = HeaderSettings::findOrFail($id);
          return response()->json([
              'success' => true,
              'header' => $header
          ]);
      }

      public function update(Request $request, $id)
      {
          $header = HeaderSettings::findOrFail($id);   
      
          $validator = Validator::make($request->all(), [
              'image' => 'nullable',
              'heading1' => 'nullable|string|max:255',
              'heading2' => 'nullable|string|max:255',
              'heading3' => 'nullable|string|max:255',
              'heading4' => 'nullable|string|max:255',
              'heading5' => 'nullable|string|max:255',

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
                  $imagePath = $fileName;
      
                   $header->image = $imagePath;
              }
          }
      
    
          if ($request->has('heading1')) {
              $header->heading1 = $request->heading1;
          }
          if ($request->has('heading2')) {
            $header->heading2 = $request->heading2;
          }
          if ($request->has('heading3')) {
            $header->heading3 = $request->heading3;
          }
          if ($request->has('heading4')) {
            $header->heading4 = $request->heading4;
          }
          if ($request->has('heading5')) {
            $header->heading5 = $request->heading5;
          }
      
           $header->save();
      
          return response()->json([
              'success' => true,
              'message' => 'header updated successfully!',
              'header' => $header
          ], 200);
      }
      

public function deleteheader(Request $request)
{
    $header = HeaderSettings::find($request->header_id);

    if ($header) {
        $header->delete();
        return response()->json(['success' => true, 'message' => 'header deleted successfully']);
    }

    return response()->json(['success' => false, 'message' => 'header not found']);
}
       
}
