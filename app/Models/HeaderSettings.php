<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderSettings extends Model
{
    protected $fillable = [
        'image',
        'heading1',
        'heading2',
        'heading3',
        'heading4',
        'heading5',
    ];
}
