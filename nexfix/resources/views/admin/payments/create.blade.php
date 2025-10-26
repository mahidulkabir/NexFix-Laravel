@extends('layouts.admin_Home_page')

@section('content')
<div class="container mt-4">
    <h2>Add Payment</h2>
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Booking</label>
            <select name="booking_id" class="form-control">
                @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}">#{{ $booking->id }} - {{ $booking->user->name ?? 'User' }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Payment Method</label>
            <select name="method" class="form-control">
                <option value="cash">Cash</option>
                <option value="online">Online</option>
                <option value="bkash">Bkash</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="failed">Failed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Payment</button>
    </form>
</div>
@endsection
