@extends('layouts.admin_Home_page')

@section('content')
<div class="container">
    <h2>Add Review</h2>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Booking</label>
            <select name="booking_id" class="form-control">
                @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}">{{ $booking->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Vendor</label>
            <select name="vendor_id" class="form-control">
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Rating (1–5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5">
        </div>

        <div class="mb-3">
            <label>Comment</label>
            <textarea name="comment" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Add Review</button>
    </form>
</div>
@endsection
