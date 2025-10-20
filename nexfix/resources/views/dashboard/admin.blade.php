@extends('layouts.admin')

@section('content')
<h1>Welcome, {{ auth()->user()->name }}!</h1>
<p>Manage your platform here.</p>
@endsection


