@extends('layouts.admin_Home_page')

@section('content')
<div class="container mt-4">
    <h2>Bookings List</h2>
    <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">Add Booking</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Service</th>
                <th>Vendor</th>
                <th>Booking Date</th>
                <th>Scheduled At</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                <td>{{ $booking->service->name ?? 'N/A' }}</td>
                <td>{{ $booking->vendorService->vendor->company_name ?? 'N/A' }}</td>
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->scheduled_at ?? '-' }}</td>
                <td>{{ $booking->total_amount ?? '0.00' }}</td>
                <td>{{ ucfirst($booking->payment_status) }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td>{{ $booking->notes ?? '-' }}</td>
                <td>
                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
