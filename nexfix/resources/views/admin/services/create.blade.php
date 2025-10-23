@extends('layouts.admin_Home_page')

@section('content')
<div class="container">
    <h2>Add Service</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.services.partials.form')
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
