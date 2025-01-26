    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-dismissible position-relative overflow-hidden fade show shadow "
            style="pointer-events: auto;" role="alert">
            {{ $message }}
            <a href="#" class="float-end text-decoration-none" data-bs-dismiss="alert" aria-label="Close">Close</a>
        </div>
    @endif


    @if ($message = Session::get('error'))

        <div class="alert alert-danger alert-dismissible position-relative overflow-hidden fade show shadow "
            style="pointer-events: auto;" role="alert">
            {{ $message }}
            <a href="#" class="float-end text-decoration-none" data-bs-dismiss="alert" aria-label="Close">Close</a>
        </div>
    @endif


    @if ($message = Session::get('warning'))

        <div class="alert alert-warning alert-dismissible position-relative overflow-hidden fade show shadow "
            style="pointer-events: auto;" role="alert">
            {{ $message }}
            <a href="#" class="float-end text-decoration-none" data-bs-dismiss="alert" aria-label="Close">Close</a>
        </div>
    @endif


    @if ($message = Session::get('info'))
        <div class="alert alert-info alert-dismissible position-relative overflow-hidden fade show shadow "
            style="pointer-events: auto;" role="alert">
            {{ $message }}
            <a href="#" class="float-end text-decoration-none" data-bs-dismiss="alert" aria-label="Close">Close</a>
        </div>
    @endif

