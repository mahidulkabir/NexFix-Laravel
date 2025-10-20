@extends('layouts.admin_Home_page')

@section('content')
<h2>Edit Service Category</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('service-categories.update', $serviceCategory->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-2">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $serviceCategory->name }}" required>
    </div>
    <div class="mb-2">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $serviceCategory->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update Category</button>
</form>
@endsection
