@extends('layouts.admin_Home_page')

@section('content')
<div class="container">
    <h2>Edit Vendor</h2>
    <form method="POST" action="{{ route('vendors.update', $vendor->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Company Name</label>
            <input type="text" name="company_name" value="{{ $vendor->company_name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $vendor->phone }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" value="{{ $vendor->address }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Verified</label>
            <input type="checkbox" name="verified" value="1" {{ $vendor->verified ? 'checked' : '' }}>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
