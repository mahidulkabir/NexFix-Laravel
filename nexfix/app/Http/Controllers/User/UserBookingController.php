<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // Ensure the logged-in user owns this booking
    if ($booking->user_id !== Auth::id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }
    

    $booking->status_user = $request->status_user;
    $booking->save();

    return response()->json(['message' => 'Booking status updated successfully.']);
}

}
