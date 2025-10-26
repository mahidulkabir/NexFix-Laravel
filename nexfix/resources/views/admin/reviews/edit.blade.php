@extends('layouts.admin_Home_page')

@section('content')
<div class="container">
    <h2>Edit Review</h2>
    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Booking</label>
            <select name="booking_id" class="form-control">
                @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}" {{ $booking->id == $review->booking_id ? 'selected' : '' }}>{{ $booking->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $review->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Vendor</label>
            <select name="vendor_id" class="form-control">
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}" {{ $vendor->id == $review->vendor_id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Rating</label>
            <input type="number" name="rating" class="form-control" value="{{ $review->rating }}" min="1" max="5">
        </div>

        <div class="mb-3">
            <label>Comment</label>
            <textarea name="comment" class="form-control">{{ $review->comment }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Review</button>
    </form>
</div>
@endsection
