@extends('layouts.admin_Home_page')

@section('content')
<h1>Welcome, {{ auth()->user()->name }}!</h1>
<p>Manage your platform here. Ok?</p>
@endsection


