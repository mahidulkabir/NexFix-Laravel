@extends('layouts.admin_Home_page')

@section('content')
<h2>Service Categories</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif



<table class="table table-bordered my-5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>
                <a href="{{ route('service-categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('service-categories.destroy', $category->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('service-categories.create') }}" class="btn btn-primary mb-3 float-end">Add Category</a>
@endsection
