@extends('layouts.admin_Home_page')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-primary mb-4">Vendor Payout Management</h2>

    @if(session('success'))
        <div class="alert alert-success text-center rounded-pill py-2">{{ session('success') }}</div>
    @endif

    @if($payouts->count() > 0)
        <div class="card shadow-sm rounded-4 border-0">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Vendor</th>
                                <th>Booking ID</th>
                                <th>Total Amount</th>
                                <th>Admin Commission</th>
                                <th>Vendor Earnings</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payouts as $key => $payout)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $payout->vendor->company_name ?? 'N/A' }}</td>
                                    <td>#{{ $payout->booking_id }}</td>
                                    <td><strong>{{ number_format($payout->total_amount, 2) }}</strong> ৳</td>
                                    <td class="text-danger">-{{ number_format($payout->admin_commission, 2) }} ৳</td>
                                    <td class="text-success">{{ number_format($payout->vendor_earning, 2) }} ৳</td>
                                    <td>
                                        @if($payout->status === 'paid')
                                            <span class="badge bg-success-subtle text-success border border-success">Paid</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning border border-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $payout->created_at->format('d M, Y') }}</td>
                                    <td>
                                        @if($payout->status === 'pending')
                                            <form method="POST" action="{{ route('admin.payouts.markPaid', $payout->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3 py-1">
                                                    <i class="fa fa-check me-1"></i> Mark Paid
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-success rounded-pill px-3 py-1" disabled>
                                                <i class="fa fa-check-circle me-1"></i> Paid
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fa fa-wallet text-secondary fs-1 mb-3"></i>
            <p class="lead text-muted">No payouts available yet.</p>
        </div>
    @endif
</div>

<style>
    .bg-success-subtle { background-color: #eaf8ef !important; }
    .bg-warning-subtle { background-color: #fff6e5 !important; }
    table th { white-space: nowrap; }
    .btn { transition: all .2s ease; }
    .btn:hover { transform: translateY(-2px); }
</style>
@endsection
