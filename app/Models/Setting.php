<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'email',
        'number',
        'youtube',
        'tiktok',
        'instagram',
        'facebook',
        'twitter',
        'delivery_charges',
    ];
}
