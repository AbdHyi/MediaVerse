<x-app-layout>
    <div class="container py-4">
        @php
            $spaceClass = match ($profileUser->role) {
                'admin' => 'dashboard-space-admin',
                'absolute_admin' => 'dashboard-space-absolute',
                default => 'dashboard-space-user',
            };
        @endphp
        <div class="dashboard-space-bg {{ $spaceClass }}">
            @if (session('success'))
            <div class="alert alert-success" id="flashAlert">{{ session('success') }}</div>
            @endif

        <div class="row g-4">
            {{-- Kolom Kiri: Avatar & Info --}}
            <div class="col-md-3">
                <div class="card p-3 text-center">
                    <img src="{{ $profileUser->avatar_path ? asset('storage/'.$profileUser->avatar_path) : asset('images/avatar-placeholder.png') }}"
                         class="rounded-circle mx-auto mb-3" style="width:150px;height:150px;object-fit:cover;" alt="{{ $profileUser->name }}">
                    <h5>{{ $profileUser->name }}</h5>
                    <p class="text-secondary small">{{ ucfirst($profileUser->role) }}</p>

                    @if ($isOwner)
                        <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                            @csrf
                            <input type="file" name="avatar" class="form-control form-control-sm mb-2" accept="image/*" required>
                            <button class="btn btn-sm btn-outline-warning w-100">Ganti Foto</button>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Kolom Kanan: Watchlist, Favorite, Review, Comment --}}
            <div class="col-md-9">
                {{-- Watchlist (3 terbaru) --}}
                <div class="card p-3 mb-3">
                    <h6 class="mb-3">📌 Watchlist Terbaru</h6>
                    <div class="row g-2">
                        @forelse ($watchlist as $item)
                            <div class="col-4"><x-media-card :media="$item->media" /></div>
                        @empty
                            <p class="text-secondary">Belum ada watchlist.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Favorite (carousel kalau >10) --}}
                <div class="card p-3 mb-3">
                    <h6 class="mb-3">❤️ Favorite</h6>
                    @if ($favorites->isEmpty())
                        <p class="text-secondary">Belum ada favorite.</p>
                    @elseif ($favorites->count() > 10)
                        <div id="favCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($favorites->chunk(4) as $index => $group)
                                    <div class="carousel-item @if ($index === 0) active @endif">
                                        <div class="row g-2">
                                            @foreach ($group as $fav)
                                                <div class="col-3"><x-media-card :media="$fav->media" /></div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#favCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                            <button class="carousel-control-next" type="button" data-bs-target="#favCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                        </div>
                    @else
                        <div class="row g-2">
                            @foreach ($favorites as $fav)
                                <div class="col-3"><x-media-card :media="$fav->media" /></div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Review (3 terakhir) --}}
                <div class="card p-3 mb-3">
                    <h6 class="mb-3">📝 Review Terakhir</h6>
                    @forelse ($reviews as $review)
                        <div class="border-bottom border-secondary py-2">
                            <strong>{{ $review->media->title }}</strong> — ⭐ {{ $review->rating }}/10
                            <p class="mb-0 text-secondary">{{ $review->review_text }}</p>
                        </div>
                    @empty
                        <p class="text-secondary">Belum ada review.</p>
                    @endforelse
                </div>

                {{-- Komentar --}}
                <div class="card p-3">
                    <h6 class="mb-3">💬 Komentar</h6>

                    @auth
                        <form action="{{ route('profile.comments.store', $profileUser) }}" method="POST" class="mb-3">
                            @csrf
                            <textarea name="body" class="form-control mb-2" placeholder="Tulis komentar..." required></textarea>
                            <button class="btn btn-sm btn-warning">Kirim</button>
                        </form>
                    @endauth

                    @forelse ($comments as $comment)
                        <div class="border-bottom border-secondary py-2">
                            <strong>{{ $comment->commenter->name }}</strong>
                            <p class="mb-0 text-secondary">{{ $comment->body }}</p>
                        </div>
                    @empty
                        <p class="text-secondary">Belum ada komentar.</p>
                    @endforelse
                </div>
            </div>
        </div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const el = document.getElementById('flashAlert');
            if (el) el.style.display = 'none';
        }, 3000);
    </script>
</x-app-layout>