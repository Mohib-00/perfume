<?php

namespace App\Http\Controllers;

use App\Models\SectionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DetailsController extends Controller
{
    public function  adddetails(){ 
        $user = Auth::user();
        $details = SectionDetail::all();
        return view('adminpages.sectiondetails', ['userName' => $user->name],compact('details'));
      }


      public function store(Request $request)
      {
          $validator = Validator::make($request->all(), [
               'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
               'heading' => 'required|string|max:255',
               'paragraph' => 'nullable',
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
      
          $detail = SectionDetail::create([
              'image' => $fileName,
              'heading' => $request->heading,
              'paragraph' => $request->paragraph,
          ]);
      
          return response()->json([
              'success' => true,
              'message' => 'Service added successfully!',
              'detail' => $detail
          ], 200);
      }
      
      

      public function show($id)
      {
          $detail = SectionDetail::findOrFail($id);
          return response()->json([
              'success' => true,
              'detail' => $detail
          ]);
      }

      public function update(Request $request, $id)
      {
          $detail = SectionDetail::findOrFail($id);   
      
          $validator = Validator::make($request->all(), [
              'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
              'name' => 'nullable|string|max:255',
              'paragraph' => 'nullable',
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
      
                   $detail->image = $imagePath;
              }
          }
      
    
          if ($request->has('heading')) {
              $detail->heading = $request->heading;
          }

          if ($request->has('paragraph')) {
            $detail->paragraph = $request->paragraph;
        }
      
           $detail->save();
      
          return response()->json([
              'success' => true,
              'message' => 'Detail updated successfully!',
              'detail' => $detail
          ], 200);
      }
      

public function deletedetail(Request $request)
{
    $detail = SectionDetail::find($request->detail_id);

    if ($detail) {
        $detail->delete();
        return response()->json(['success' => true, 'message' => 'Detail deleted successfully']);
    }

    return response()->json(['success' => false, 'message' => 'Detail not found']);
}
}
