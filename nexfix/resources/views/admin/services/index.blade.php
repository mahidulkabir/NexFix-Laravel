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
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Base Price</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($services as $service)
            <tr>
                <td>
                    @if($service->image)
                        <img src="{{ asset('storage/'.$service->image) }}" alt="Service Image" width="70" height="70" style="object-fit:cover; border-radius:8px;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->category->name ?? 'N/A' }}</td>
                <td>
                    {{ \Illuminate\Support\Str::limit($service->description, 50, '...') }}
                </td>
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
