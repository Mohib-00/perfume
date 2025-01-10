<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\SectionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DetailsController extends Controller
{
    public function  adddetails(){ 
        $user = Auth::user();
        $details = SectionDetail::all();
        $count = Message::whereHas('messageStatus', function ($query) {
            $query->where('status', 1);
            })->count();
        return view('adminpages.sectiondetails', ['userName' => $user->name, 'count' => $count],compact('details'));
      }


      public function store(Request $request)
      {
          // Validation
          $validator = Validator::make($request->all(), [
              'image' => 'required|image|max:2048',
              'heading' => 'required|string|max:255',
              'paragraph' => 'nullable|string',
          ]);
  
          if ($validator->fails()) {
              return response()->json(['errors' => $validator->errors()], 422);
          }
  
          $fileName = null;
  
          // Check if image file exists and upload it
          if ($request->hasFile('image')) {
              $file = $request->file('image');
              if ($file->isValid()) {
                  $uniqueTimestamp = time();
                  $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                  $file->move(public_path('images'), $fileName);
              }
          }
  
          // Create new SectionDetail
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
  
          // Validation
          $validator = Validator::make($request->all(), [
              'image' => 'nullable|image|max:2048',
              'heading' => 'nullable|string|max:255',
              'paragraph' => 'nullable|string',
          ]);
  
          if ($validator->fails()) {
              return response()->json(['errors' => $validator->errors()], 422);
          }
  
          $fileName = $detail->image;
  
          // Check if image is being uploaded
          if ($request->hasFile('image')) {
              $file = $request->file('image');
              if ($file->isValid()) {
                  $uniqueTimestamp = time();
                  $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                  $file->move(public_path('images'), $fileName);
              }
          }
  
          // Update details
          $detail->image = $fileName;
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
