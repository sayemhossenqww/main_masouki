@extends('layouts.app')
@section('title', 'Submit your order')

@section('content')
    @if (!$is_store_open)
        <div class="alert alert-warning shadow-sm alert-dismissible mt-3 fade show rounded-main" role="alert">
            <mt-icon icon="info" styleName="me-1"></mt-icon> {{ $closed_message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <submit-order-component></submit-order-component>
@endsection
