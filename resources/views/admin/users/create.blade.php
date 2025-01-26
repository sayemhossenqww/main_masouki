@extends('admin.layouts.app')
@section('title', 'Create New User')
@section('page_name', 'Create New User')

@section('content')

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label for="name" class="col-sm-12 col-form-label"> Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-12 col-form-label"> Email</label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-12 col-form-label">Password</label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password_confirmation" class="col-sm-12 col-form-label"> Confirm Password</label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary px-4" type="submit">Create User</button>
                </div>
            </form>

        </div>

    </div>

@endsection
