@extends('dashboard.user');
@section('content')
<div class="container mt-4">
    <h2>My Bookings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($bookings->count() > 0)
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Vendor</th>
                    <th>Scheduled Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->service->name ?? 'N/A' }}</td>
                        <td>{{ $booking->vendor->company_name ?? 'N/A' }}</td>
                        <td>{{ $booking->scheduled_at }}</td>
                        <td>{{ ucfirst($booking->status_user ?? 'Pending') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You have no bookings yet.</p>
    @endif
</div>
@endsection