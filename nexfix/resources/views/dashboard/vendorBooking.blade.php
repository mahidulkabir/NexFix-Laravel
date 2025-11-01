@extends('dashboard.vendor')

@section('content')
    <h3>My Bookings</h3>
    <hr>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->vendorService->service->title }}</td>
                        <td>{{ $booking->date }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
