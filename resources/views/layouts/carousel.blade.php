@if (!$banners->isEmpty())
    <div id="carouselIconVisionFade" class="carousel slide carousel-fade shadow-sm" data-bs-ride="carousel">
        <div class="carousel-inner rounded-0">
            @foreach ($banners as $banner)
                <div class="carousel-item @if ($loop->first) active @endif">
                    @if ($banner->link)
                        <a href="{{ $banner->link }}">
                            <img src="{{ $banner->image_url }}" class="d-block rounded-0" alt="banner">
                        </a>
                    @else
                        <img src="{{ $banner->image_url }}" class="d-block rounded-0" alt="banner">
                    @endif
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIconVisionFade"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselIconVisionFade"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endif
