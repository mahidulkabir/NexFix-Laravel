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
        $vendors = Vendor::all();
        return view('admin.bookings.index', compact('bookings', 'vendors'));
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
            // 🟢 REMOVED: 'status'
            'status_user' => 'nullable|in:completed,cancelled', // 🟢 ADDED
            'status_vendor' => 'nullable|in:accepted,completed,cancelled', // 🟢 ADDED
            'total_amount' => 'nullable|numeric',
            'payment_status' => 'required|in:unpaid,paid',
            'payment_method' => 'required|in:bKash,nagad,card', // 🟢 Added for consistency
            'notes' => 'nullable|string',
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        $users = User::where('role', 'user')->get();
        $services = Service::all();
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
            // 🟢 REMOVED: 'status'
            'status_user' => 'nullable|in:completed,cancelled', // 🟢 ADDED
            'status_vendor' => 'nullable|in:accepted,completed,cancelled', // 🟢 ADDED
            'payment_status' => 'required|in:unpaid,paid',
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
            'status_user' => $request->status_user,       // 🟢 ADDED
            'status_vendor' => $request->status_vendor,   // 🟢 ADDED
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method ?? 'bKash', // 🟢 Optional safety default
            'notes' => $request->notes,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }

    public function ajaxUpdate(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'vendor_id' => 'nullable|exists:vendors,id',
            'payment_status' => 'required|in:paid,unpaid',
            // 🟢 REMOVED: 'status'
            'status_user' => 'nullable|in:completed,cancelled', // 🟢 ADDED
            'status_vendor' => 'nullable|in:accepted,completed,cancelled', // 🟢 ADDED
        ]);

        // Determine the current service_id
        $service_id = $booking->vendorService?->service_id;

        if ($request->vendor_id) {
            if (!$service_id) {
                $vendorService = VendorService::where('vendor_id', $request->vendor_id)->first();
                if (!$vendorService) {
                    return response()->json([
                        'message' => 'Selected vendor does not provide any service.'
                    ], 422);
                }
                $booking->vendor_service_id = $vendorService->id;
            } else {
                $vendorService = VendorService::where('vendor_id', $request->vendor_id)
                    ->where('service_id', $service_id)
                    ->first();

                if (!$vendorService) {
                    return response()->json([
                        'message' => 'Selected vendor does not provide this service.'
                    ], 422);
                }

                $booking->vendor_service_id = $vendorService->id;
            }
        }

        $booking->payment_status = $request->payment_status;
        $booking->status_user = $request->status_user;       // 🟢 ADDED
        $booking->status_vendor = $request->status_vendor;   // 🟢 ADDED
        $booking->save();

        return response()->json(['message' => 'Booking updated successfully!']);
    }
}
