<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\VendorPayout;

class Booking extends Model
{
    protected $fillable = ['user_id', 'service_id', 'vendor_service_id', 'vendor_id', 'booking_date', 'scheduled_at', 'address', 'total_amount', 'payment_method', 'payment_status', 'status_user', 'status_vendor', 'notes'];

    // Relationships

// public function createPayoutIfCompleted()
// {
//     if (
//         strtolower($this->status_user) === 'completed' &&
//         strtolower($this->status_vendor) === 'completed' &&
//         !$this->payout
//     ) {
//         DB::transaction(function () {
//             $adminCommissionRate = 0.10;
//             $adminCommission = $this->total_amount * $adminCommissionRate;
//             $vendorEarning = $this->total_amount - $adminCommission;

//             VendorPayout::create([
//                 'booking_id' => $this->id,
//                 'vendor_id' => $this->vendor_id,
//                 'amount' => $vendorEarning,
//                 'admin_commission' => $adminCommission,
//                 'status' => 'pending',
//             ]);

//             $this->update(['status' => 'completed']);
//         });
//     }
// }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function vendorService()
    {
        return $this->belongsTo(VendorService::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function payout()
    {
        return $this->hasOne(VendorPayout::class, 'booking_id');
    }
}
