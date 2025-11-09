<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // for showing table 
    public function index()
    {
        $bookings = Booking::with(['user', 'vendorService.vendor', 'service'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }
// for creating new entry 
    public function create()
    {
        $users = User::where('role', 'user')->get();
        $vendorServices = VendorService::with(['vendor', 'service'])->get();
        return view('admin.bookings.create', compact('users', 'vendorServices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'vendor_service_id' => 'required|exists:vendor_services,id',
            'booking_date' => 'required|date',
            'scheduled_at' => 'nullable|date',
            'address' => 'required|string|max:255',
            'status' => 'required|in:pending,accepted,completed,cancelled',
            'total_amount' => 'nullable|numeric',
            'payment_status' => 'required|in:unpaid,paid',
            'notes' => 'nullable|string',
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        $users = User::where('role', 'user')->get();
        $services = Service::all();  // ✅ Needed for the new dropdown
        $vendors = Vendor::all();
        $vendorServices = VendorService::with(['vendor', 'service'])->get();
        return view('admin.bookings.edit', compact('booking', 'users', 'services', 'vendors', 'vendorServices'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'service_id' => 'required|exists:services,id',
        'vendor_id' => 'required|exists:vendors,id',
        'booking_date' => 'required|date',
        'status' => 'required',
        'payment_status' => 'required',
    ]);

    $booking = Booking::findOrFail($id);

    // Find the matching vendor_service
    $vendorService = VendorService::where('service_id', $request->service_id)
        ->where('vendor_id', $request->vendor_id)
        ->firstOrFail();

    $booking->update([
        'user_id' => $request->user_id,
        'vendor_service_id' => $vendorService->id,
        'booking_date' => $request->booking_date,
        'scheduled_at' => $request->scheduled_at,
        'address' => $request->address,
        'total_amount' => $request->total_amount,
        'status' => $request->status,
        'payment_status' => $request->payment_status,
        'notes' => $request->notes,
    ]);

    return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
}


    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
