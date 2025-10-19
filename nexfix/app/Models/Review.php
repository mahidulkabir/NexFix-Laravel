<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function booking() {
    return $this->belongsTo(Booking::class);
}
public function user() {
    return $this->belongsTo(User::class);
}
public function vendor() {
    return $this->belongsTo(Vendor::class);
}
}
