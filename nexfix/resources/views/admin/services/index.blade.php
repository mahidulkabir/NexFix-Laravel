@extends('layouts.admin_Home_page')

@section('content')
<div class="container">
    <h2>Services</h2>
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Add Service</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Base Price</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->category->name ?? 'N/A' }}</td>
                    <td>{{ $service->base_price }}</td>
                    <td>{{ $service->active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $services->links() }}
</div>
@endsection
