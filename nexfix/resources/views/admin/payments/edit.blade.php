@extends('layouts.admin_Home_page')

@section('content')
<div class="container mt-4">
    <h2>Edit Payment</h2>
    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Booking</label>
            <select name="booking_id" class="form-control">
                @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}" {{ $payment->booking_id == $booking->id ? 'selected' : '' }}>#{{ $booking->id }} - {{ $booking->user->name ?? 'User' }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $payment->amount }}" required>
        </div>

        <div class="mb-3">
            <label>Payment Method</label>
            <select name="method" class="form-control">
                @foreach(['cash','online','bkash'] as $m)
                    <option value="{{ $m }}" {{ $payment->method == $m ? 'selected' : '' }}>{{ ucfirst($m) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                @foreach(['pending','completed','failed'] as $s)
                    <option value="{{ $s }}" {{ $payment->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Payment</button>
    </form>
</div>
@endsection
