@extends('layouts.admin_Home_page')

@section('content')
<div class="container">
    <h2>Vendors List</h2>
    <a href="{{ route('vendors.create') }}" class="btn btn-primary mb-3">Add Vendor</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Company</th><th>User</th><th>Phone</th><th>Verified</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->id }}</td>
                    <td>{{ $vendor->company_name }}</td>
                    <td>{{ $vendor->user->name }}</td>
                    <td>{{ $vendor->phone }}</td>
                    <td>{{ $vendor->verified ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete vendor?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $vendors->links() }}
</div>
@endsection
