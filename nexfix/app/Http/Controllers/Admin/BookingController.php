<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\VendorService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'vendorService'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        $vendorServices = VendorService::all();
        return view('admin.bookings.create', compact('users', 'vendorServices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'vendor_service_id' => 'required',
            'date' => 'required|date',
            'address' => 'required|string',
            'status' => 'required'
        ]);

        Booking::create($request->all());
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        $users = User::where('role', 'user')->get();
        $vendorServices = VendorService::all();
        return view('admin.bookings.edit', compact('booking', 'users', 'vendorServices'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id' => 'required',
            'vendor_service_id' => 'required',
            'date' => 'required|date',
            'address' => 'required|string',
            'status' => 'required'
        ]);

        $booking->update($request->all());
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
