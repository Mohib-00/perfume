<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageStatus extends Model
{
    use HasFactory;

    protected $table = 'messagestatus';

    protected $fillable = [
        'message_id',
        'status',
    ];

    /**
     * Relationship with Message.
     */
    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }
}
