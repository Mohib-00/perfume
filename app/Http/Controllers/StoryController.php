<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoryController extends Controller
{
    public function  addstory(){ 
        $user = Auth::user();
        $stories = Story::all();
        return view('adminpages.addstory', ['userName' => $user->name],compact('stories'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:2048',
            'image_story' => 'required|image|max:2048',
            'image_1' => 'required|image|max:2048',
            'heading' => 'nullable|string|max:255',
            'heading_story' => 'nullable|string|max:255',
            'paragraph' => 'nullable|string|max:255',
            'paragraph_story' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
         $imagePath = null;
        $imageStoryPath = null;
        $image1Path = null;
    
         if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $uniqueTimestamp = time();
                $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $fileName);
                $imagePath = $fileName;
            }
        }
    
         if ($request->hasFile('image_story')) {
            $file = $request->file('image_story');
            if ($file->isValid()) {
                $uniqueTimestamp = time();
                $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $fileName);
                $imageStoryPath = $fileName;
            }
        }
    
         if ($request->hasFile('image_1')) {
            $file = $request->file('image_1');
            if ($file->isValid()) {
                $uniqueTimestamp = time();
                $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $fileName);
                $image1Path = $fileName;
            }
        }
    
         $story = Story::create([
            'image' => $imagePath,
            'image_story' => $imageStoryPath,
            'image_1' => $image1Path,
            'heading' => $request->heading,
            'heading_story' => $request->heading_story,
            'paragraph' => $request->paragraph,
            'paragraph_story' => $request->paragraph_story,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Story added successfully!',
            'story' => $story
        ], 200);
    }
    
      
      

      public function show($id)
      {
          $story = Story::findOrFail($id);
          return response()->json([
              'success' => true,
              'story' => $story
          ]);
      }

      public function update(Request $request, $id)
      {
          $story = Story::findOrFail($id);   
      
          $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|max:2048',
            'image_story' => 'nullable|image|max:2048',
            'image_1' => 'nullable|image|max:2048',
            'heading' => 'nullable|string|max:255',
            'heading_story' => 'nullable|string|max:255',
            'paragraph' => 'nullable|string|max:255',
            'paragraph_story' => 'nullable|string',
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
      
                   $story->image = $imagePath;
              }
          }

          if ($request->hasFile('image_story')) {
            $file = $request->file('image_story');
            if ($file->isValid()) {
                $uniqueTimestamp = time();
                $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $fileName);
                $imagePath = $fileName;
    
                 $story->image_story = $imagePath;
            }
        }

        if ($request->hasFile('image_1')) {
            $file = $request->file('image_1');
            if ($file->isValid()) {
                $uniqueTimestamp = time();
                $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $fileName);
                $imagePath = $fileName;
    
                 $story->image_1 = $imagePath;
            }
        }
      
    
          if ($request->has('heading')) {
              $story->heading = $request->heading;
          }
          if ($request->has('heading_story')) {
            $story->heading_story = $request->heading_story;
          }
          if ($request->has('paragraph')) {
            $story->paragraph = $request->paragraph;
          }
          if ($request->has('heading_story')) {
            $story->paragraph_story = $request->paragraph_story;
          }
      
           $story->save();
      
          return response()->json([
              'success' => true,
              'message' => 'Story updated successfully!',
              'story' => $story
          ], 200);
      }
      

public function deleteStory(Request $request)
{
    $story = Story::find($request->story_id);

    if ($story) {
        $story->delete();
        return response()->json(['success' => true, 'message' => 'Story deleted successfully']);
    }

    return response()->json(['success' => false, 'message' => 'Story not found']);
}
       
}
