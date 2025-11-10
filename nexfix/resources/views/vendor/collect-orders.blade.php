@extends('layouts.vendor_Home_page')

@section('content')
<div class="container mt-4">
    <h2>Available Orders</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($bookings->count() > 0)
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service</th>
                    <th>User</th>
                    <th>Booking Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->service->name ?? 'N/A' }}</td>
                    <td>{{ $booking->user->name ?? 'N/A' }}</td>
                    <td>{{ $booking->booking_date }}</td>
                    <td>
                        <form action="{{ route('vendor.accept.order', $booking->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Accept</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No new orders available right now.</p>
    @endif
</div>
@endsection
