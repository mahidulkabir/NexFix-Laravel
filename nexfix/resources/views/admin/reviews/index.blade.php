@extends('layouts.admin_Home_page')

@section('content')
<div class="container">
    <h2>All Reviews</h2>
    <a href="{{ route('reviews.create') }}" class="btn btn-primary mb-3">Add Review</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Booking</th>
                <th>User</th>
                <th>Vendor</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->booking->id ?? 'N/A' }}</td>
                <td>{{ $review->user->name ?? 'N/A' }}</td>
                <td>{{ $review->vendor->name ?? 'N/A' }}</td>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->comment }}</td>
                <td>
                    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this review?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
