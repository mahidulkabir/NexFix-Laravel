<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorDashboardController extends Controller
{
    public function index()
{
    $vendorID = Auth::user()->id;
    $bookings = Booking::with(['user','vendorService.service'])
    ->whereHas('vendorService',function($query) use ($vendorID){
        $query->where('vendor_id',$vendorID);
    })->latest()->get();
    return view('dashboard.vendor',compact('bookings'));
}

public function bookings()
{
    $vendorId = Auth::user()->id;

    $bookings = Booking::with(['user', 'vendorService.service'])
        ->whereHas('vendorService', fn($q) => $q->where('vendor_id', $vendorId))
        ->latest()
        ->get();

    return view('dashboard.vendorBooking', compact('bookings'));
}


}
