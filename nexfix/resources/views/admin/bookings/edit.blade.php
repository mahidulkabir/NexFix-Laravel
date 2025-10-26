@extends('layouts.admin_Home_page')

@section('content')
<div class="container mt-4">
    <h2>Edit Booking</h2>
    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Vendor Service</label>
            <select name="vendor_service_id" class="form-control">
                @foreach($vendorServices as $vs)
                    <option value="{{ $vs->id }}" {{ $booking->vendor_service_id == $vs->id ? 'selected' : '' }}>{{ $vs->service->name ?? 'Unnamed Service' }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="{{ $booking->date }}" required>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="{{ $booking->address }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                @foreach(['pending','accepted','completed','cancelled'] as $st)
                    <option value="{{ $st }}" {{ $booking->status == $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Booking</button>
    </form>
</div>
@endsection
