<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    public function addblogs()
    {
     $user = Auth::user();   
     $blogs = Blog::all();  
     $count = Message::whereHas('messageStatus', function ($query) {
     $query->where('status', 1);
     })->count();
     return view('adminpages.blogs', ['userName' => $user->name, 'count' => $count], compact('blogs'));
  }

  public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'sub_image' => 'nullable',
            'heading' => 'nullable',
            'paragraph' => 'nullable',
            
        ]);

        $blog = new Blog();

       

        if ($request->hasFile('sub_image')) {
            $file = $request->file('sub_image');
            if ($file->isValid()) {
                $uniqueTimestamp = time();
                $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $fileName);
                $blog->sub_image = $fileName;
            }
        }

        $blog->heading = $request->heading;
        $blog->paragraph = $request->paragraph;
         
        $blog->save();

        return response()->json(['success' => true, 'blog' => $blog]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

public function show($id)
{
    $blog = Blog::find($id);

    if ($blog) {
        return response()->json([
            'success' => true,
            'blog' => $blog
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'blog not found'
    ], 404);
}

public function update(Request $request, $id)
{
    try {
      $validatedData = $request->validate([
        'sub_image' => 'nullable',
        'heading' => 'nullable',
        'paragraph' => 'nullable',
        
    ]);

        $blog = Blog::findOrFail($id);

      

      if ($request->hasFile('sub_image')) {
          $file = $request->file('sub_image');
          if ($file->isValid()) {
              $uniqueTimestamp = time();
              $fileName = $uniqueTimestamp . '-' . $file->getClientOriginalName();
              $file->move(public_path('images'), $fileName);
              $blog->sub_image = $fileName;
          }
      }

      $blog->heading = $request->heading;
      $blog->paragraph = $request->paragraph;
       
      $blog->save();

        return response()->json(['success' => true, 'blog' => $blog]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}



public function deleteblog(Request $request)
      {
          $blog = Blog::find($request->blog_id);
      
          if ($blog) {
              $blog->delete();
      
              return response()->json(['success' => true, 'message' => 'blog deleted successfully']);
          }
      
          return response()->json(['success' => false, 'message' => 'blog not found']);
      }
}
