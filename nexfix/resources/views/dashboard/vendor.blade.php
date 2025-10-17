@extends('layouts.vendor')

@section('content')
<h1>Welcome, {{ auth()->user()->name }}!</h1>
<p>This is your vendor dashboard.</p>
@endsection


