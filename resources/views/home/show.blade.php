@extends('layouts.app')
@section('content')
    <!-- open Wings Modal -->
    {{-- <div class="modal fade" id="openWingsModal" tabindex="-1" aria-labelledby="openWingsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-body overflow-hidden p-0 position-relative">
                    <img src="{{ asset('images/webp/open-wings.webp') }}" class="w-100 h-100" alt="">
                    <div class="position-absolute top-0 end-0">
                        <button type="button" class="btn-close bg-white p-2 m-3" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- open Wings Modal -->
    <home-component></home-component>
    {{-- <cart-bottom-button-component></cart-bottom-button-component> --}}
@endsection
