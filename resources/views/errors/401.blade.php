@extends('errors.master')
@section('title', 'Not authorized')
@section('content')
    <h1>401</h1>
    <h3>Not authorized</h3>
    <p>You do not have permission to access this page</p>
    <a href="{{ route('home') }}" class="btn btn-danger mt-1 px-5 shadow-sm">Back To Home Page</a>
@endsection
