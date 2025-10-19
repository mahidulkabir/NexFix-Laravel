<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    public function services(){
        return $this->hasMany(Service::class);
    }
}
