<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\ShowcaseImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShowcaseController extends Controller
{
    public function  addshowcasedata(){ 
        $user = Auth::user();
        $showcases = ShowcaseImage::all();
        $count = Message::whereHas('messageStatus', function ($query) {
            $query->where('status', 1);
            })->count();
        return view('adminpages.showcseimage', ['userName' => $user->name, 'count' => $count],compact('showcases'));
      }


      public function store(Request $request)
      {
          $validator = Validator::make($request->all(), [
               'image' => 'required',
               'name' => 'nullable|string|max:255',
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
            }
        }
      
          $showcase = ShowcaseImage::create([
              'image' => $fileName,
              'name' => $request->name,
          ]);
      
          return response()->json([
              'success' => true,
              'message' => 'Showcase added successfully!',
              'showcase' => $showcase
          ], 200);
      }
      
      

      public function show($id)
      {
          $showcase = ShowcaseImage::findOrFail($id);
          return response()->json([
              'success' => true,
              'showcase' => $showcase
          ]);
      }

      public function update(Request $request, $id)
      {
          $showcase = ShowcaseImage::findOrFail($id);   
      
          $validator = Validator::make($request->all(), [
              'image' => 'nullable',
              'name' => 'nullable|string|max:255',
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
      
                   $showcase->image = $imagePath;
              }
          }
      
    
          if ($request->has('name')) {
              $showcase->name = $request->name;
          }
      
           $showcase->save();
      
          return response()->json([
              'success' => true,
              'message' => 'showcase updated successfully!',
              'showcase' => $showcase
          ], 200);
      }
      

public function deleteshowcase(Request $request)
{
    $showcase = ShowcaseImage::find($request->showcase_id);

    if ($showcase) {
        $showcase->delete();
        return response()->json(['success' => true, 'message' => 'showcase deleted successfully']);
    }

    return response()->json(['success' => false, 'message' => 'showcase not found']);
}
       
}
