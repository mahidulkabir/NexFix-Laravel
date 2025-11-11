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
                    <!-- <th>ID</th> -->
                    <th>Service</th>
                    <th>User</th>
                    <th>User Phone</th>
                    <th>User Address</th>
                    <th>Scheduled Date</th>
                    <th>Status (Vendor)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        {{-- <!-- <td>{{ $booking->id }}</td> --> --}}
                        <td>{{ $booking->service->name ?? 'N/A' }}</td>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->user->phone ?? 'N/A' }}</td>
                        <td>{{ $booking->address ?? 'N/A' }}</td>
                        <td>{{ $booking->scheduled_at }}</td>
                       <!-- 🟩 NEW: Dropdown for vendor status -->
                    <td>
                        <select class="form-select status-vendor-select" 
                                data-id="{{ $booking->id }}">
                            
                            <option value="accepted" 
                                {{ $booking->status_vendor == 'accepted' ? 'selected' : '' }}>
                                Accepted
                            </option>
                            <option value="completed" 
                                {{ $booking->status_vendor == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                            <option value="cancelled" 
                                {{ $booking->status_vendor == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>
                        </select>
                    </td>
                     <td>
                        <button class="btn btn-sm btn-primary update-status-btn" 
                                data-id="{{ $booking->id }}">
                            Update
                        </button>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You haven’t accepted any orders yet.</p>
    @endif
</div>
{{-- ✅ AJAX Script --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.update-status-btn').click(function() {
        const bookingId = $(this).data('id');
        const newStatus = $(`select[data-id="${bookingId}"]`).val();

        $.ajax({
            url: `/vendor/orders/${bookingId}/update-status`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status_vendor: newStatus
            },
            success: function(response) {
                alert(response.message);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Failed to update status.');
            }
        });
    });
});
</script>
@endsection
