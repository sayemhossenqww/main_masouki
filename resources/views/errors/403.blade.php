@extends('errors.master')
@section('title', '403 Access denied!')
@section('content')
    <h1>403</h1>
    <h3>Access denied!</h3>
    <p>
        You do not have permission to access this feature.
    </p>
    <a href="{{ route('home') }}" class="btn btn-danger mt-1 px-5 shadow-sm">Back To Home Page</a>
@endsection
