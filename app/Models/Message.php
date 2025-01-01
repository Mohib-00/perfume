<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'status',
    ];

    /**
     * Relationship with MessageStatus.
     */
    public function messageStatus()
    {
        return $this->hasOne(MessageStatus::class, 'message_id', 'id');
    }
}
