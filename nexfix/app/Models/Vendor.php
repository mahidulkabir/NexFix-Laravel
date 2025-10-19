<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function vendorServices(){
        return $this ->hasMany(VendorService::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
