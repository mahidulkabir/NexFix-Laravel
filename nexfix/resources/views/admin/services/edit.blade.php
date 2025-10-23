@extends('layouts.admin_Home_page')

@section('content')
<div class="container">
    <h2>Edit Service</h2>
    <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.services.partials.form')
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
