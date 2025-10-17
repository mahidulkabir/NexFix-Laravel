@extends('layouts.user')

@section('content')
<h1>Welcome, {{ auth()->user()->name }}!</h1>
<p>This is your user dashboard.</p>
@endsection

