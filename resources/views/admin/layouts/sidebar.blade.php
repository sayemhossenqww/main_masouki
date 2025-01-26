<div class="bg-sidebar sticky-top shadow-sm" id="sidebar-wrapper" role="tablist">
    <div class="sidebar-heading pb-0">
        <img src="{{ asset('images/webp/logo-header.png') }}" height="35" alt="Narjes">
    </div>
    <div class="list-group list-group-flush m-2">

        @foreach ($items as $item)
            <a class="list-group-item list-group-item-action sidebar-item align-items-center d-flex py-3
            @if ($item['active']) text-primary @endif"
                href="{{ $item['route'] }}" @if ($item['is_blank']) target="_blank" @endif>
                <span class="material-symbols-rounded me-3" stylename="me-2">{{ $item['icon'] }}</span>
                {{ $item['name'] }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" style="width: 1.25rem;height: 1.25rem;" class="ms-auto">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>

            </a>
        @endforeach
    </div>
</div>
