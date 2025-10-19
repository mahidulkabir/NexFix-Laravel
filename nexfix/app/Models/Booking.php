<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function vendorService(){
        return $this->belongsTo(VendorService::class);
    }
    public function payment(){
        return $this->belongsTo(VendorService::class);
    }
    public function review(){
        return $this->hasOne(Review::class);
    }

}
