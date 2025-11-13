<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Commission;
use App\Models\VendorPayout;

class VendorBookingController extends Controller
{
    // List available orders to collect
    public function collectOrders()
    {
        $vendor = Auth::user()->vendor;

        // Find service IDs vendor offers
        $serviceIds = $vendor->vendorServices->pluck('service_id');

        // Get bookings for those services that no vendor has taken yet
        $bookings = Booking::whereNull('vendor_id')
            ->whereIn('service_id', $serviceIds)
            ->whereNull('status_vendor') // optional filter
            ->get();

        return view('vendor.collect-orders', compact('bookings'));
    }

    // Vendor accepts a booking
    public function acceptOrder($id)
    {
        $vendor = Auth::user()->vendor;
        $booking = Booking::findOrFail($id);

        if ($booking->vendor_id === null) {
            $booking->update([
                'vendor_id' => $vendor->id,
                'status_vendor' => 'accepted',
            ]);
            return redirect()->back()->with('success', 'Order accepted successfully!');
        }

        return redirect()->back()->with('error', 'Sorry, this order has already been taken.');
    }

    // View vendor’s own bookings
    public function myOrders()
    {
        $vendor = Auth::user()->vendor;
        $bookings = Booking::where('vendor_id', $vendor->id)->get();

        return view('vendor.my-orders', compact('bookings'));
    }

    // updating vendor status

    public function updateStatus(Request $request, $id)
{
    $vendor = Auth::user()->vendor;

    if (!$vendor) {
        return response()->json(['message' => 'Vendor profile not found.'], 403);
    }

    $booking = Booking::where('vendor_id', $vendor->id)->findOrFail($id);

    $request->validate([
        'status_vendor' => 'required|string|in:accepted,completed,cancelled',
    ]);

    $booking->update([
        'status_vendor' => $request->status_vendor,
    ]);

    // Check and create payout if both sides completed
    $this->checkAndCreatePayout($booking);

    return response()->json(['message' => 'Booking status updated successfully!']);
}

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
