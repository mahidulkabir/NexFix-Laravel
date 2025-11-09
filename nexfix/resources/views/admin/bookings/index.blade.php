@extends('layouts.admin_Home_page')

@section('content')
    <div class="container mt-4">
        <h2>Bookings List</h2>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">Add Booking</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered" id="bookingsTable">
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
                @foreach ($bookings as $booking)
                    <tr id="booking-{{ $booking->id }}">
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->service->name ?? 'N/A' }}</td>

                        <!-- Vendor Dropdown -->
                        <td>
                            <select class="form-select vendor-select" data-id="{{ $booking->id }}">
                                <option value="">Select Vendor</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}"
                                        {{ $booking->vendorService?->vendor_id == $vendor->id ? 'selected' : '' }}>
                                        {{ $vendor->company_name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->scheduled_at ?? '-' }}</td>
                        <td>{{ $booking->total_amount ?? '0.00' }}</td>

                        <!-- Payment Dropdown -->
                        <td>
                            <select class="form-select payment-select" data-id="{{ $booking->id }}">
                                @foreach (['unpaid', 'paid', 'refunded'] as $pay)
                                    <option value="{{ $pay }}"
                                        {{ $booking->payment_status == $pay ? 'selected' : '' }}>
                                        {{ ucfirst($pay) }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <!-- Status Dropdown -->
                        <td>
                            <select class="form-select status-select" data-id="{{ $booking->id }}">
                                @foreach (['pending', 'accepted', 'completed', 'cancelled'] as $stat)
                                    <option value="{{ $stat }}" {{ $booking->status == $stat ? 'selected' : '' }}>
                                        {{ ucfirst($stat) }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td>{{ $booking->notes ?? '-' }}</td>

                        <td class="d-flex justify-center align-items-center gap-3">
                            <!-- AJAX Update button -->
                            <button class="btn btn-success btn-sm update-booking d-flex align-items-center gap-1" data-id="{{ $booking->id }}">
                                <i class="fa fa-sync-alt"></i> Update
                                <!-- or using Bootstrap Icon -->
                                <!-- <i class="bi bi-arrow-repeat"></i> Update -->
                            </button>

                            <!-- Edit button -->
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                                <!-- <i class="bi bi-pencil-square"></i> Edit -->
                            </a>

                            <!-- Delete button -->
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i> 
                                    <!-- <i class="bi bi-trash"></i> Delete -->
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- AJAX Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.update-booking', function() {
            let id = $(this).data('id');
            let vendor_id = $(`#booking-${id} .vendor-select`).val();
            let payment_status = $(`#booking-${id} .payment-select`).val();
            let status = $(`#booking-${id} .status-select`).val();

            $.ajax({
                url: `/admin/bookings/${id}/ajax-update`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    vendor_id: vendor_id,
                    payment_status: payment_status,
                    status: status
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr) {
                    alert('Update failed: ' + xhr.responseJSON?.message);
                }
            });
        });
    </script>
@endsection
