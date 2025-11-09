@extends('layouts.admin_Home_page')

@section('content')
<div class="container mt-4">
    <h2>Add Booking</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control" required>
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Vendor Service</label>
            <select name="vendor_service_id" class="form-control" required>
                <option value="">Select Service</option>
                @foreach($vendorServices as $vs)
                    <option value="{{ $vs->id }}">{{ $vs->service->name }} - {{ $vs->vendor->company_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Booking Date</label>
            <input type="date" name="booking_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" class="form-control">
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="form-control">
        </div>

        <div class="mb-3">
            <label>Payment Status</label>
            <select name="payment_status" class="form-control" required>
                <option value="unpaid">Unpaid</option>
                <option value="paid">Paid</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="accepted">Accepted</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Add Booking</button>
    </form>
</div>
@endsection
