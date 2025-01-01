<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function message()
      {
       $user = Auth::user();   
       MessageStatus::truncate();  
       $messages = Message::all();  
       $count = Message::whereHas('messageStatus', function ($query) {
       $query->where('status', 1);
       })->count();
       return view('adminpages.messages', ['userName' => $user->name, 'count' => $count], compact('messages'));
    }
    public function submitMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:11',
            'message' => 'required|string|max:5000',
        ]);
    
        
        $message = Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);
    
        
        MessageStatus::create([
            'message_id' => $message->id,   
            'status' => 1,
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Message submitted successfully!',
        ]);
    }

    public function deletemessage(Request $request)
    {
        $message = Message::find($request->message_id);
    
        if ($message) {
            $message->delete();
            return response()->json(['success' => true, 'message' => 'Message deleted successfully']);
        }
    
        return response()->json(['success' => false, 'message' => 'Message not found']);
    }

    public function updateStatus(Request $request)
    {
        $message = Message::find($request->message_id);
    
        if ($message) {
            $message->status = 1;  
            $message->save();
    
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }
    
        return response()->json(['success' => false, 'message' => 'Message not found.'], 404);
    }
}
