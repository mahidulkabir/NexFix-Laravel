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
                    {{-- <th>ID</th> --}}
                    <th>User</th>
                    <th>Service</th>
                    <th>Vendor</th>
                    <th>Booking Date</th>
                    <th>Scheduled At</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Payment Method</th>
                    <th>User Status</th> {{-- 🟢 CHANGED: replaced old “Status” --}}
                    <th>Vendor Status</th> {{-- 🟢 CHANGED: added vendor status --}}
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr id="booking-{{ $booking->id }}">
                        {{-- <td>{{ $booking->id }}</td> --}}
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->service->name ?? 'N/A' }}</td>

                        <!-- Vendor Dropdown -->


                        <td>{{ $booking->vendor->company_name ?? '-' }}</td>


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

                        <td>{{ $booking->payment_method ?? 'not paid' }}</td>
                        <!-- 🟢 CHANGED: Split status into two dropdowns -->

                        <!-- User Status Dropdown -->
                        <td>
                            <select class="form-select status-user-select" data-id="{{ $booking->id }}">
                                <option value="">--</option>
                                @foreach (['completed', 'cancelled'] as $stat)
                                    <option value="{{ $stat }}"
                                        {{ $booking->status_user == $stat ? 'selected' : '' }}>
                                        {{ ucfirst($stat) }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <!-- Vendor Status Dropdown -->
                        <td>
                            <select class="form-select status-vendor-select" data-id="{{ $booking->id }}">
                                <option value="">--</option>
                                @foreach (['accepted', 'completed', 'cancelled'] as $stat)
                                    <option value="{{ $stat }}"
                                        {{ $booking->status_vendor == $stat ? 'selected' : '' }}>
                                        {{ ucfirst($stat) }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td>{{ $booking->notes ?? '-' }}</td>

                        <td class="d-flex justify-center align-items-center gap-3">
                            <!-- AJAX Update button -->
                            <button class="btn btn-success btn-sm update-booking d-flex align-items-center gap-1"
                                data-id="{{ $booking->id }}">
                                <i class="fa fa-sync-alt"></i> Update
                            </button>

                            <!-- Edit button -->
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>

                            <!-- Delete button -->
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 🟢 CHANGED: Updated AJAX Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.update-booking', function() {
            let id = $(this).data('id');
            let vendor_id = $(`#booking-${id} .vendor-select`).val();
            let payment_status = $(`#booking-${id} .payment-select`).val();
            let status_user = $(`#booking-${id} .status-user-select`).val();
            let status_vendor = $(`#booking-${id} .status-vendor-select`).val();

            $.ajax({
                url: `/admin/bookings/${id}/ajax-update`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    vendor_id: vendor_id,
                    payment_status: payment_status,
                    status_user: status_user,
                    status_vendor: status_vendor
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
