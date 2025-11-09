<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorService;
class UserBookingController extends Controller
{
    /**
     * Store a newly created booking from checkout.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        // Validate checkout form data
        $request->validate([
            'address' => 'required|string|max:255',
            'scheduled_at' => 'required|date|after:now',
            'payment_method' => 'required|string|in:bkash,nagad,card',
            'notes' => 'nullable|string',
            // 'service_id' => 'required|exists:services,id',
        ]);

        // Get authenticated user and selected service
        $service = Service::findOrFail($request->service_id);

        // Create a booking record
        $booking = Booking::create([
            'user_id' => $user->id,
            'vendor_service_id' => null,
            'service_id'=>$service->id,
            'booking_date' => now()->toDateString(),
            'scheduled_at' => $request->scheduled_at,
            'address' => $request->address,
            'status' => 'pending',
            'total_amount' => $service->base_price,
            'payment_method' => $request->payment_method,
            'payment_status' => 'unpaid',
            'notes' => $request->notes,
        ]);

        // Optionally redirect to a confirmation page or user dashboard
        return redirect('/')->with('success', 'Your booking has been placed successfully!');

    }
}
