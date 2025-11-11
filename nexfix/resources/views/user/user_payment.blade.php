@extends('dashboard.user');
@section('content')
<div class="container mt-4">
    <h2>My Payments</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($payments->count() > 0)
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Vendor</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->service->name ?? 'N/A' }}</td>
                        <td>{{ $payment->vendor->name ?? 'N/A' }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ ucfirst($payment->status ?? 'Pending') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You have no payments yet.</p>
    @endif
</div>
@endsection