<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'is_read',
    ];

    public $timestamps = false; // since only created_at is used

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
