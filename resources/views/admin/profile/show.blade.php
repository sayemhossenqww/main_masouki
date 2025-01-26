@extends('admin.layouts.app')
@section('title', 'Profile - ' . $user->name)
@section('page_name', 'Profile')

@section('content')
    @include('admin.profile.partials.update-profile-information-form')
    @include('admin.profile.partials.update-password')
@endsection
