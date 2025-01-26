@extends('errors.master')
@section('title', 'Too Many Requests')
@section('content')
    <h1>429</h1>
    <h3>Too Many Requests</h3>
    <a href="{{ route('home') }}" class="btn btn-danger mt-1 px-5 shadow-sm">Back To Home Page</a>
@endsection
