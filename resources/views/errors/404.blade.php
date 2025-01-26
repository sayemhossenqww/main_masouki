@extends('errors.master')
@section('title', '404 Page Not Found')

@section('content')
    <h1>404</h1>
    <h3>Oops! Page Not Found</h3>
    <p>The page you requested was not found</p>
    <a href="{{ route('home') }}" class="btn btn-danger mt-1 px-5 shadow-sm">Back To Home Page</a>
@endsection
