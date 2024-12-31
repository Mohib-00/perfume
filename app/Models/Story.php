<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'heading',
        'paragraph',
        'image_story',
        'paragraph_story',
        'heading_story',
        'image_1',
    ];
}
