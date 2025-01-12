<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

   
    protected $table = 'bank';  

  
    protected $fillable = [
        'paragraph',
        'name',
        'title',
        'account_number',
        'iban',
        'branch_name',
    ];
}
