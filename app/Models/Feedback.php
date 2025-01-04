<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
 
 class Feedback extends Model
 {
      protected $table = 'feedbacks';
 
      protected $fillable = [
         'product_id', 
         'rating', 
         'review_title', 
         'name', 
         'email', 
         'message_review'
     ];

     public function product()
{
    return $this->belongsTo(Product::class, 'product_id', 'id');
}

 }
 

