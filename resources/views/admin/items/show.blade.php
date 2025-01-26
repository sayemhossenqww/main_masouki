@extends('admin.layouts.app')
@section('title', 'Menu Items')
@section('page_name', 'Menu Items')

@section('content')
    <item-component usd-rate-value="{{ $usdRate }}"></item-component>
@endsection
