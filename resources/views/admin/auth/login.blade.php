@extends('admin.auth.master')
@section('title', 'Admin Login')


@section('content')
    <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12">
        <div class=" text-center mb-3">
            <img src="{{ asset('images/webp/logo.png') }}" alt="SpecialBites" class='w-50 img-fluid mb-3'>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Admin</h5>
                <h6 class="card-subtitle mb-2 text-muted">Login</h6>
                <admin-login-component></admin-login-component>
            </div>
        </div>
    </div>
@endsection
