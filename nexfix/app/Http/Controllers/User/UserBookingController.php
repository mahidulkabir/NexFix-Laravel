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
}
