<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarouselController extends Controller
{
    public function  addcarouseldata(){ 
        $user = Auth::user();
        $carousels = Carousel::all();
        $count = Message::whereHas('messageStatus', function ($query) {
            $query->where('status', 1);
            })->count();
        return view('adminpages.addcarousel', ['userName' => $user->name, 'count' => $count],compact('carousels'));
      }


      public function store(Request $request)
      {
          $request->validate([
              'image' => 'nullable',
              'name' => 'nullable|required|string|max:255',
          ]);
      
          $carousel = Carousel::first(); 
      
          $imagePath = $setting->image ?? null;
      
          
          if ($request->hasFile('image')) {
              $file = $request->file('image');
              if ($file->isValid()) {
                  $uniqueTimestamp = time();
                  $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                  $file->move(public_path('images'), $fileName);
                  $imagePath = $fileName;
              }
          }
      
          
          $carousel = Carousel::updateOrCreate(
              ['id' => $carousel ? $carousel->id : null],
              [
                  'image' => $imagePath,
                  'name' => $request->name,
              ]
          );
      
           return response()->json([
              'success' => true,
              'message' => $carousel ? 'Carousel updated successfully!' : 'Carousel created successfully!',
              'carousel' => $carousel,  
          ]);
      }
      
      public function getcarousel($id) {
          $carousel = Carousel::find($id);
          return response()->json($carousel);
      }
      
      public function updatecarousel(Request $request, $id)
      {
          $carousel = Carousel::find($id);
      
          if (!$carousel) {
              return response()->json(['message' => 'Carousel not found'], 404);
          }
      
          if ($request->hasFile('image')) {
              $file = $request->file('image');
      
              if ($file->isValid()) {
                  $uniqueTimestamp = time();
                  $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                  $file->move(public_path('images'), $fileName);
                  $carousel->image = $fileName;
              }
          }
      
           $carousel->fill($request->only([
              'name', 
               
          ]));
      
          $carousel->save();
      
          return response()->json([
              'message' => 'carousel updated successfully',
              'carousel' => $carousel
          ]);
      }

      public function deletecarousel(Request $request)
      {
          $carousel = Carousel::find($request->carousel_id);
      
          if ($carousel) {
              $carousel->delete();
      
              return response()->json(['success' => true, 'message' => 'Carousel deleted successfully']);
          }
      
          return response()->json(['success' => false, 'message' => 'Carousel not found']);
      }
}
