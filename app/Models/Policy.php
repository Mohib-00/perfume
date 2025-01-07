<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
         
        'main_heading',
        'sub_heading',
        'paragraph',
        'show_terms',
        'show_refund',
        'show_shipping',
        'show_privacy',
    ];
}
