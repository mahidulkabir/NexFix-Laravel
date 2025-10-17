@extends('layouts.admin')

@section('content')
<h1>Welcome, Admin {{ auth()->user()->name }}!</h1>
<p>Manage your platform here.</p>
@endsection


