<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionDetail extends Model
{
    use HasFactory;

     protected $table = 'section_detail';

     protected $fillable = [
        'image',       
        'heading',    
        'paragraph',   
    ];
}
