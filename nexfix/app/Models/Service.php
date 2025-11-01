<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{ 
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'details',
        'service_category_id',
        'base_price',
        'image',
        'active',
    ];
    public function category(){
        return $this -> belongsTo(ServiceCategory::class,'service_category_id');
    }
    public function vendorServices(){
        return $this->hasMany(VendorService::class);
    }
}
