@extends('admin.layouts.app')
@section('title', 'Services')
@section('page_name', 'Services')

@section('content')
    <service-component usd-rate-value="{{ $usdRate }}"></service-component>
@endsection
