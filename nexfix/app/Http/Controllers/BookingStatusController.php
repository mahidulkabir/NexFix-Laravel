<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Commission;
use App\Models\VendorPayout;
use Illuminate\Http\Request;

class BookingStatusController extends Controller
{
    public function updateUserStatus(Request $request)
    {
        $booking = Booking::findOrFail($request->booking_id);
        $booking->status_user = $request->status_user;
        $booking->save();

        $this->checkAndCreatePayout($booking);

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function updateVendorStatus(Request $request)
    {
        $booking = Booking::findOrFail($request->booking_id);
        $booking->status_vendor = $request->status_vendor;
        $booking->save();

        $this->checkAndCreatePayout($booking);

        return response()->json(['message' => 'Status updated successfully']);
    }

    /**
     * ✅ Create payout if both parties completed
     */
    private function checkAndCreatePayout(Booking $booking)
    {
        // Only proceed if both marked completed
        if ($booking->status_user === 'Completed' && $booking->status_vendor === 'Completed') {

            // Prevent duplicate payout
            if (VendorPayout::where('booking_id', $booking->id)->exists()) {
                return;
            }

            // Get commission rate
            $commission = Commission::first()?->commission_rate ?? 10;

            // Calculate
            $total = $booking->total_amount;
            $commissionAmount = round($total * ($commission / 100), 2);
            $vendorEarning = $total - $commissionAmount;

            // Create payout record
            VendorPayout::create([
                'booking_id'        => $booking->id,
                'vendor_id'         => $booking->vendor_id,
                'total_amount'      => $total,
                'commission_amount' => $commissionAmount,
                'vendor_earning'    => $vendorEarning,
                'status'            => 'pending',
            ]);

            // Optionally log or notify admin/vendor
        }
    }
}
