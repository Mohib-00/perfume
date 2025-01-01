<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
{
    public function addOption(Request $request)
    {
         
        $request->validate([
            'product_id' => 'required|exists:products,id',  
            'option' => 'required|string|max:255',  
        ]);
 
        $option = new Option();
        $option->product_id = $request->input('product_id');
        $option->option = $request->input('option');
        $option->save();

         return response()->json([
            'success' => true,
            'message' => 'Option added successfully.',
        ]);
    }

    public function  productoptions(){ 
        $user = Auth::user();
        $options = Option::with('product')->get();
        $count = Message::whereHas('messageStatus', function ($query) {
            $query->where('status', 1);
            })->count();

        return view('adminpages.productoptions', ['userName' => $user->name, 'count' => $count],compact('options'));
      }


      public function show($id)
      {
          $option = Option::findOrFail($id);
          return response()->json([
              'success' => true,
              'option' => $option
          ]);
      }

      public function update(Request $request, $id)
      {
          $option = Option::findOrFail($id);   
      
          $validator = Validator::make($request->all(), [
               'option' => 'nullable|string|max:255',
            ]);
      
          if ($validator->fails()) {
              return response()->json(['errors' => $validator->errors()], 422);
          }
    
          if ($request->has('option')) {
              $option->option = $request->option;
          }

          
          $option->save();
      
          return response()->json([
              'success' => true,
              'message' => 'option updated successfully!',
              'option' => $option
          ], 200);
      }
      

      public function deleteoption(Request $request)
      {
           $option = Option::find($request->options_id);
  
          if ($option) {
              $option->delete();
              return response()->json(['success' => true, 'message' => 'Option deleted successfully']);
          }
  
          return response()->json(['success' => false, 'message' => 'Option not found']);
      }
}

