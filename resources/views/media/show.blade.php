<x-app-layout>
    <div class="media-backdrop" style="background-image: url('{{ $media->poster_path ? asset('storage/'.$media->poster_path) : asset('images/poster-placeholder.png') }}')">
        <div class="media-backdrop-overlay"></div>
    </div>

    <div class="container py-4" style="margin-top: -80px; position: relative; z-index: 2;">
        {{-- Tombol kembali: browser Back saja tidak reliable di sini karena toggle
             watchlist/favorite pakai pola POST -> redirect back(), jadi URL tetap
             di /media/{slug} walau Back ditekan (cuma toast-nya yang hilang duluan). --}}
        <a href="{{ route('media.index') }}" class="btn btn-sm btn-outline-warning mb-3">
            ← Kembali ke Media
        </a>

        <div class="row">
            <div class="col-md-3">
                <img src="{{ $media->poster_path ? asset('storage/'.$media->poster_path) : asset('images/poster-placeholder.png') }}"
                     class="img-fluid rounded shadow" alt="{{ $media->title }}">
            </div>
            <div class="col-md-9">
                <h2 class="fw-bold">{{ $media->title }} <span class="text-secondary fw-normal">({{ $media->release_year }})</span></h2>
                <p class="text-secondary">
                    {{ ucfirst($media->type) }} • {{ $media->studio?->name ?? 'Studio tidak diketahui' }}
                </p>
                <p>
                    @foreach ($media->genres as $genre)
                        <span class="badge bg-secondary">{{ $genre->name }}</span>
                    @endforeach
                </p>
                <p class="fs-4">⭐ {{ $media->reviews_avg_rating ? number_format($media->reviews_avg_rating, 1) : 'Belum ada rating' }} <span class="fs-6 text-secondary">/ 10</span></p>
                <p>{{ $media->synopsis }}</p>

                @auth
                    <form method="POST" action="{{ route('watchlist.toggle', $media) }}" class="d-inline">
                        @csrf
                        <button class="btn btn-outline-warning">
                            {{ $isInWatchlist ? '✓ Di Watchlist' : '+ Watchlist' }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('favorite.toggle', $media) }}" class="d-inline">
                        @csrf
                        <button class="btn btn-outline-danger">
                            {{ $isInFavorite ? '✓ Favorite' : '+ Favorite' }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-warning">+ Watchlist</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-danger">+ Favorite</a>
                @endauth
            </div>
        </div>

        <hr class="my-4">
        <h5>Review</h5>

        @auth
            <form method="POST" action="{{ route('review.store', $media) }}" class="mb-4">
                @csrf
                <div class="mb-2">
                    <label>Rating (1-10)</label>
                    <input type="number" name="rating" min="1" max="10" class="form-control" style="width:100px"
                           value="{{ $userReview->rating ?? '' }}" required>
                </div>
                <div class="mb-2">
                    <textarea name="review_text" class="form-control" placeholder="Tulis review (opsional)">{{ $userReview->review_text ?? '' }}</textarea>
                </div>
                <button class="btn btn-warning">{{ $userReview ? 'Update Review' : 'Kirim Review' }}</button>
            </form>
        @else
            <p><a href="{{ route('login') }}">Login</a> untuk menulis review.</p>
        @endauth

        @forelse ($media->reviews as $review)
            <div class="border-bottom border-secondary py-2">
                <strong>{{ $review->user->name }}</strong> — ⭐ {{ $review->rating }}/10
                <p>{{ $review->review_text }}</p>
            </div>
        @empty
            <p class="text-secondary">Belum ada review.</p>
        @endforelse
    </div>
</x-app-layout>