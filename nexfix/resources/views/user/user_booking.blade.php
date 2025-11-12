@extends('dashboard.user')
@section('content')
    <div class="container mt-5">
        <h2 class="fw-bold text-center mb-4 text-primary">My Bookings</h2>



        @if ($bookings->count() > 0)
            <div class="booking-list">
                @foreach ($bookings as $booking)
                    @php
                        $rawStatus = $booking->status_user ?? ($booking->status ?? null);
                        $statusKey = $rawStatus ? strtolower($rawStatus) : 'pending';
                    @endphp

                    <div class="booking-card border-start-5
                    @if ($statusKey == 'completed') border-success
                    @elseif($statusKey == 'cancelled') border-danger
                    @else border-secondary @endif
                    shadow-sm mb-4 bg-white rounded-4 p-4"
                        data-booking-id="{{ $booking->id }}">

                        <div class="d-flex justify-content-between align-items-start mb-3 gap-3 ">
                            <div>
                                <h5 class="fw-semibold mb-1 text-dark">
                                    <i class="fa fa-tools text-primary me-2"></i>
                                    {{ $booking->service->name ?? 'N/A' }}
                                </h5>
                                <p class="text-muted mb-1">
                                    <i class="fa fa-user-tie text-secondary me-2"></i>
                                    Vendor: <strong>{{ $booking->vendor->company_name ?? 'N/A' }}</strong>
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="fa fa-dollar-sign text-secondary me-2"></i>
                                    Price: <strong>{{ $booking->total_amount ?? 'N/A' }}</strong>
                                </p>
                                <p class="text-muted mb-0">
                                    <i class="fa fa-calendar-alt text-secondary me-2"></i>
                                    Scheduled:
                                    <strong>{{ \Carbon\Carbon::parse($booking->scheduled_at)->format('d M, Y h:i A') }}</strong>
                                </p>
                            </div>

                            <div class="text-end">
                                <span
                                    class="badge status-badge px-3 py-2
                                @if ($statusKey == 'completed') bg-success-subtle text-success border border-success
                                @elseif($statusKey == 'cancelled') bg-danger-subtle text-danger border border-danger
                                @else bg-secondary-subtle text-secondary border border-secondary @endif"
                                    data-status="{{ $statusKey }}">
                                    {{ ucfirst($statusKey) }}
                                </span>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="action-area text-center mt-3">
                            @if ($statusKey == 'pending')
                                <button class="btn btn-success me-2 do-confirm-status" data-id="{{ $booking->id }}"
                                    data-status="Completed">
                                    <i class="fa fa-check me-1"></i> Complete
                                </button>
                                <button class="btn btn-outline-danger do-confirm-status" data-id="{{ $booking->id }}"
                                    data-status="Cancelled">
                                    <i class="fa fa-times me-1"></i> Cancel
                                </button>
                            @endif
                        </div>

                        {{-- Booking footer bar --}}
                        <div
                            class="status-bar mt-3 p-3 text-center fw-semibold rounded-3
                        @if ($statusKey == 'completed') bg-success-subtle text-success
                        @elseif($statusKey == 'cancelled') bg-danger-subtle text-danger
                        @else bg-light text-secondary @endif">
                            @if ($statusKey == 'pending')
                                Awaiting confirmation...
                            @elseif($statusKey == 'completed')
                                Order Completed Successfully
                            @elseif($statusKey == 'cancelled')
                                Order Cancelled
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fa fa-calendar-times text-secondary fs-1 mb-3"></i>
                <p class="lead text-muted">You have no bookings yet.</p>
            </div>
        @endif
    </div>

    {{-- ✅ Confirmation Modal --}}
    <div class="modal fade" id="confirmStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-semibold text-primary">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-6 text-muted mb-0" id="confirmMessage"></p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmActionBtn">Yes, Confirm</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ Styles --}}
    <style>
        .booking-card {
            border-left-width: 6px !important;
            transition: all 0.28s ease;
        }

        .booking-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.06);
        }

        .booking-list {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }

        .status-badge {
            font-size: 0.9rem;
            border-radius: 50px;
        }

        .btn {
            border-radius: 8px;
            min-width: 110px;
            transition: all .15s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .bg-success-subtle {
            background-color: #e8f7ee !important;
        }

        .bg-danger-subtle {
            background-color: #fce8e6 !important;
        }

        .bg-secondary-subtle {
            background-color: #f6f6f6 !important;
        }
    </style>

    {{-- ✅ Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(function(){
    let selectedBookingId = null;
    let selectedStatus = null;
    let processing = false; // ✅ Prevent double submissions

    // show modal
    $(document).on('click', '.do-confirm-status', function(){
        if (processing) return; // prevent click if already processing
        selectedBookingId = $(this).data('id');
        selectedStatus = $(this).data('status');

        let msg = selectedStatus === 'Completed'
            ? 'Are you sure you want to mark this booking as <strong>Completed</strong>?'
            : 'Are you sure you want to <strong>Cancel</strong> this booking?';

        $('#confirmMessage').html(msg);
        $('#confirmStatusModal').modal('show');
    });

    // confirm action
    $('#confirmActionBtn').off('click').on('click', function(){
        if (processing || !selectedBookingId || !selectedStatus) return;
        processing = true;

        $('#confirmStatusModal').modal('hide');

        $.ajax({
            url: '{{ route("user.updateBookingStatus") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                booking_id: selectedBookingId,
                status_user: selectedStatus
            },
            success: function(res){
                processing = false;

                let card = $('[data-booking-id="'+selectedBookingId+'"]');
                let badge = card.find('.status-badge');
                let statusBar = card.find('.status-bar');

                // update badge
                let key = selectedStatus.toLowerCase();
                badge.text(selectedStatus);
                badge.attr('data-status', key);
                badge.removeClass('bg-success-subtle text-success border-success bg-danger-subtle text-danger border-danger bg-secondary-subtle text-secondary border-secondary');
                if (key === 'completed') badge.addClass('bg-success-subtle text-success border border-success');
                else if (key === 'cancelled') badge.addClass('bg-danger-subtle text-danger border border-danger');
                else badge.addClass('bg-secondary-subtle text-secondary border border-secondary');

                // update card border color
                card.removeClass('border-success border-danger border-secondary');
                if (key === 'completed') card.addClass('border-success');
                else if (key === 'cancelled') card.addClass('border-danger');
                else card.addClass('border-secondary');

                // hide buttons area smoothly
                card.find('.action-area').fadeOut(300, function(){ $(this).remove(); });

                // update footer/status bar
                statusBar.removeClass('bg-light text-secondary bg-success-subtle text-success bg-danger-subtle text-danger');
                if (key === 'completed')
                    statusBar.addClass('bg-success-subtle text-success').text('Order Completed Successfully');
                else if (key === 'cancelled')
                    statusBar.addClass('bg-danger-subtle text-danger').text('Order Cancelled');
                else
                    statusBar.addClass('bg-light text-secondary').text('Awaiting confirmation...');

                // show a temporary top notification (no alerts)
                $('.top-toast').remove(); // remove old
                const toast = $('<div class="top-toast alert alert-success position-fixed top-0 start-50 translate-middle-x mt-3 shadow rounded-pill px-4 py-2 small text-center">'+(res.message || "Status updated successfully")+'</div>');
                $('body').append(toast);
                setTimeout(() => toast.fadeOut(400, () => toast.remove()), 1800);
            },
            error: function(){
                processing = false;
                $('.top-toast').remove();
                const toast = $('<div class="top-toast alert alert-danger position-fixed top-0 start-50 translate-middle-x mt-3 shadow rounded-pill px-4 py-2 small text-center">Could not update status. Try again.</div>');
                $('body').append(toast);
                setTimeout(() => toast.fadeOut(400, () => toast.remove()), 2000);
            }
        });
    });
});
</script>

@endsection
