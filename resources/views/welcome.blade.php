<x-app-layout>
    <div class="container py-5 text-white">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">MediaVerse</h1>
            <p class="text-secondary">Katalog Film, Series, dan Anime — Review, Rating, Watchlist, Favorite.</p>
            <a href="{{ route('media.index') }}" class="btn btn-warning btn-lg">Mulai Jelajahi</a>
        </div>

        <h4 class="mb-3">🔥 Trending</h4>

        @if ($trending->isNotEmpty())
            <div id="trendingCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($trending as $index => $group)
                        <div class="carousel-item @if ($index === 0) active @endif">
                            <div class="row g-3">
                                @foreach ($group as $media)
                                    <div class="col-6 col-md-3">
                                        <x-media-card :media="$media" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#trendingCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#trendingCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        @else
            <p class="text-secondary">Belum ada data trending.</p>
        @endif
    </div>
</x-app-layout>