@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h1 class="fw-bold">Welcome to NexFix Admin Dashboard 👋</h1>
            <p class="text-muted">Manage vendors, users, bookings, and payments all from one place.</p>
        </div>
    </div>

    {{-- Example Cards --}}
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Vendors</h5>
                    <p class="card-text fs-4 fw-semibold text-primary">54</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Active Services</h5>
                    <p class="card-text fs-4 fw-semibold text-success">128</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Bookings Today</h5>
                    <p class="card-text fs-4 fw-semibold text-warning">23</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Pending Payments</h5>
                    <p class="card-text fs-4 fw-semibold text-danger">5</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
