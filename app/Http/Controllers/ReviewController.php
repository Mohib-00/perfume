<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{

    public function  viewfeedback(){ 
        $user = Auth::user();
        $feedbacks = Feedback::all();
        $count = Message::whereHas('messageStatus', function ($query) {
            $query->where('status', 1);
            })->count();
        return view('adminpages.feedback', ['userName' => $user->name, 'count' => $count],compact('feedbacks'));
      }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review_title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message_review' => 'required|string',
        ]);

        Feedback::create($validated);

        return response()->json(['message' => 'Review submitted successfully.']);
    }


    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return response()->json([
            'success' => true,
            'feedback' => $feedback
        ]);
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);   
    
        $validator = Validator::make($request->all(), [
             'rating' => 'nullable|string|max:255',
             'review_title' => 'nullable|string|max:255',
             'name' => 'nullable|string|max:255',
             'email' => 'nullable|email|max:255',
             'message_review' => 'nullable|string|max:255',

         ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        if ($request->has('rating')) {
            $feedback->rating = $request->rating;
        }
        if ($request->has('review_title')) {
            $feedback->review_title = $request->review_title;
        }
        if ($request->has('name')) {
            $feedback->name = $request->name;
        }
        if ($request->has('email')) {
            $feedback->email = $request->email;
        }
        if ($request->has('message_review')) {
            $feedback->message_review = $request->message_review;
        }
    
         $feedback->save();
    
        return response()->json([
            'success' => true,
            'message' => 'feedback updated successfully!',
            'feedback' => $feedback
        ], 200);
    }
    

public function deletefeedback(Request $request)
{
  $feedback = Feedback::find($request->feedback_id);

  if ($feedback) {
      $feedback->delete();
      return response()->json(['success' => true, 'message' => 'feedback deleted successfully']);
  }

  return response()->json(['success' => false, 'message' => 'feedback not found']);
}
     
}
