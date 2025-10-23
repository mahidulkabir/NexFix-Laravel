@extends('layouts.admin_Home_page')

@section('content')
<div class="container">
    <h2>Add Service</h2>
    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.services.partials.form')
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
