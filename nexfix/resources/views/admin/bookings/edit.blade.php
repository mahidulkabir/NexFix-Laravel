@extends('layouts.admin_Home_page')

@section('content')
<div class="container mt-4">
    <h2>Edit Booking</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Service</label>
            <select name="service_id" id="service_id" class="form-control" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}"
                        {{ optional($booking->vendorService)->service_id == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Vendor</label>
            <select name="vendor_id" id="vendor_id" class="form-control" required>
                @foreach ($vendors as $vendor)
                    <option value="{{ $vendor->id }}"
                        {{ $booking->vendorService?->vendor_id == $vendor->id ? 'selected' : '' }}>
                        {{ $vendor->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Booking Date</label>
            <input type="date" name="booking_date" value="{{ $booking->booking_date }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" value="{{ $booking->scheduled_at }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" value="{{ $booking->address }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Total Amount</label>
            <input type="number" step="0.01" name="total_amount" value="{{ $booking->total_amount }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Payment Status</label>
            <select name="payment_status" class="form-control" required>
                <option value="unpaid" {{ $booking->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>

        <!-- 🟢 CHANGED: Split old Status into User + Vendor Status -->
        <div class="mb-3">
            <label>User Status</label>
            <select name="status_user" class="form-control">
                <option value="">--</option>
                <option value="completed" {{ $booking->status_user == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $booking->status_user == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Vendor Status</label>
            <select name="status_vendor" class="form-control">
                <option value="">--</option>
                <option value="accepted" {{ $booking->status_vendor == 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="completed" {{ $booking->status_vendor == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $booking->status_vendor == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control">{{ $booking->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Booking</button>
    </form>
</div>
@endsection
