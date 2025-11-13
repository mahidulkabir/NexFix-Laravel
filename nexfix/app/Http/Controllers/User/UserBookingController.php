<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Commission;
use App\Models\VendorPayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserBookingController extends Controller
{
    public function showBooking()
    {
        $user = Auth:: user();
        $bookings = Booking::where('user_id',$user->id)->get();
        return view('user.user_booking',compact('bookings'));
    }
   public function updateStatus(Request $request)
{
    $request->validate([
        'booking_id' => 'required|exists:bookings,id',
        'status_user' => 'required|in:Pending,Completed,Cancelled',
    ]);

    $booking = Booking::findOrFail($request->booking_id);

    if ($booking->user_id !== Auth::id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $booking->status_user = $request->status_user ?? $booking->status_user;
    $booking->save();

    // Check and create payout if both sides completed
    $this->checkAndCreatePayout($booking);

    return response()->json(['message' => 'Booking status updated successfully.']);
}

/**
 * Check both statuses and create payout if needed
 */
protected function checkAndCreatePayout(Booking $booking)
{
   
    if ($booking->status_user === 'completed' && $booking->status_vendor === 'completed') {
        if (VendorPayout::where('booking_id', $booking->id)->exists()) return;

        $commissionRate = Commission::first()?->commission_rate ?? 10;
        $total = $booking->total_amount ?? 0;
        if ($total <= 0) return;

        $commissionAmount = round($total * ($commissionRate / 100), 2);
        $vendorEarning = $total - $commissionAmount;

        VendorPayout::create([
            'booking_id' => $booking->id,
            'vendor_id' => $booking->vendor_id,
            'total_amount' => $total,
            'commission_amount' => $commissionAmount,
            'vendor_earning' => $vendorEarning,
            'status' => 'pending',
        ]);
       
    }
}


}
