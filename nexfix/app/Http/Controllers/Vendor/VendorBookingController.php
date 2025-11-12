<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

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

        

        return response()->json(['message' => 'Booking status updated successfully!']);
    }
}
