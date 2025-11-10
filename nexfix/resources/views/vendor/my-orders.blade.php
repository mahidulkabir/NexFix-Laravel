@extends('layouts.vendor_Home_page')

@section('content')
<div class="container mt-4">
    <h2>My Accepted Orders</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($bookings->count() > 0)
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service</th>
                    <th>User</th>
                    <th>Booking Date</th>
                    <th>Status (Vendor)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->service->name ?? 'N/A' }}</td>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ ucfirst($booking->status_vendor ?? 'Pending') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You haven’t accepted any orders yet.</p>
    @endif
</div>
@endsection
