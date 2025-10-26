<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Booking;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['booking', 'user', 'vendor'])->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        $bookings = Booking::all();
        $users = User::where('role', 'user')->get();
        $vendors = Vendor::all();
        return view('admin.reviews.create', compact('bookings', 'users', 'vendors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'user_id' => 'required|exists:users,id',
            'vendor_id' => 'required|exists:vendors,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create($request->all());
        return redirect()->route('reviews.index')->with('success', 'Review added successfully.');
    }

    public function edit(Review $review)
    {
        $bookings = Booking::all();
        $users = User::where('role', 'user')->get();
        $vendors = Vendor::all();
        return view('admin.reviews.edit', compact('review', 'bookings', 'users', 'vendors'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'user_id' => 'required|exists:users,id',
            'vendor_id' => 'required|exists:vendors,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review->update($request->all());
        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}
