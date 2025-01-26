<nav class="navbar navbar-expand navbar-light bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link text-dark">
                    @if ($is_store_open)
                        <img src="{{ asset('images/open-20x20.png') }}" alt="Open"> Open
                    @else
                        <img src="{{ asset('images/closed-20x20.png') }}" alt="closed"> Closed
                    @endif
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            {{-- <li class="nav-item">
                <a class="nav-link" href="mailto:{{ config('app.email') }}">
                    <i class="uicon ic_rr_envelope fs-1x"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tel:{{ config('app.phone') }}">
                    <i class="uicon ic_rr_smartphone fs-1x"></i>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link text-facebook" href="https://facebook.com/{{ config('app.facebook_username') }}"
                    target="_blank">
                    <img src="{{ asset('images/webp/social-icons/facebook.webp') }}" width="20" height="20"
                        alt="facebook">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-facebook"
                    href="https://www.facebook.com/messages/t/{{ config('app.messenger_id') }}" target="_blank">
                    <img src="{{ asset('images/webp/social-icons/messenger.webp') }}" width="20" height="20"
                        alt="facebook messenger">
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-black" href="https://www.instagram.com/{{ config('app.instagram_username') }}"
                    target="_blank">
                    <img src="{{ asset('images/webp/social-icons/instagram.webp') }}" width="20" height="20"
                        alt="instagram">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" href="https://www.tiktok.com/{{ config('app.tiktok_username') }}"
                    target="_blank">
                    <img src="{{ asset('images/webp/social-icons/tiktok.webp') }}" width="20" height="20"
                        alt="tiktok">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-whatsapp" href="https://wa.me/{{ config('app.whatsapp') }}" target="_blank">
                    <img src="{{ asset('images/webp/social-icons/whatsapp.webp') }}" width="20" height="20"
                        alt="whatsapp">
                </a>
            </li>
        </ul>
    </div>
</nav>
