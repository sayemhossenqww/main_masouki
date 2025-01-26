<div class="offcanvas offcanvas-start bg-white" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header">
        @auth
            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" height="30"
                class="me-1 rounded-circle"> {{ Auth::user()->first_name }}
        @endauth

        <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <div class="list-group list-group-flush mb-3">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                    <mt-icon icon="dashboard" class="me-2"></mt-icon> @lang('Admin Panel')
                </a>
            @endauth

            @foreach ($items as $item)
                <a href="{{ $item['route'] }}"
                    class="list-group-item list-group-item-action py-3 px-3 d-flex align-items-center
                @if ($item['active']) text-primary @endif"
                    @if ($item['is_blank']) target="_blank" @endif>
                    <mt-icon icon="{{ $item['icon'] }}" class="me-2"></mt-icon> {{ $item['name'] }}
                </a>
            @endforeach
        </div>
        <div class="mb-3">
            @include('layouts.social-buttons')
        </div>
        <div class="text-center px-3">
            @include('layouts.copyright')
        </div>
        <div class="row justify-content-center">
            {{-- <div class="col-6">
                <a href="#">
                    <img src="{{ asset('images/play-store.svg') }}" class="w-100" alt="google-play">
                </a>
            </div> --}}
            {{-- <div class="col-6">
                <a href="#">
                    <img src="{{ asset('images/app-store.svg') }}" class="w-100" alt="app-store">
                </a>
            </div> --}}
        </div>
    </div>
</div>
