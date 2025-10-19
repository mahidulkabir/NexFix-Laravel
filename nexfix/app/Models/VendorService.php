<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorService extends Model
{
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
