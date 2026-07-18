{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard</h2>
    </x-slot>

    <div class="container py-4">
        <div class="dashboard-space-bg dashboard-space-user">
            <h4>Halo, {{ auth()->user()->name }} 👋</h4>

            <div class="row g-3 my-3">
                <div class="col-md-4">
                    <div class="card bg-dark text-white p-3">
                        <div class="fs-3 fw-bold">{{ $stats['watchlist_count'] }}</div>
                        <div>Watchlist</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-dark text-white p-3">
                        <div class="fs-3 fw-bold">{{ $stats['favorite_count'] }}</div>
                        <div>Favorite</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-dark text-white p-3">
                        <div class="fs-3 fw-bold">{{ $stats['review_count'] }}</div>
                        <div>Review</div>
                    </div>
                </div>
            </div>

            <a href="{{ route('media.index') }}" class="btn btn-warning">Browse Media</a>

            <h5 class="mt-4">Watchlist Terbaru</h5>
            @forelse ($recentWatchlist as $item)
                <p>{{ $item->media->title }}</p>
            @empty
                <p class="text-muted">Belum ada watchlist.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>