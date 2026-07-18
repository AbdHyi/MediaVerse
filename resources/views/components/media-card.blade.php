@props(['media'])

<div class="card h-100 bg-dark text-white border-secondary">
    <img src="{{ $media->poster_path ? asset('storage/'.$media->poster_path) : asset('images/poster-placeholder.png') }}"
         class="card-img-top" alt="{{ $media->title }}" style="height: 300px; object-fit: cover;">
    <div class="card-body">
        <h6 class="card-title mb-1">{{ $media->title }}</h6>
        <p class="text-secondary small mb-1">
            {{ ucfirst($media->type) }} • {{ $media->release_year ?? '-' }}
        </p>
        <span class="badge bg-warning text-dark">
            ⭐ {{ $media->reviews_avg_rating ? number_format($media->reviews_avg_rating, 1) : 'N/A' }}
        </span>
    </div>
    <div class="card-footer border-secondary">
        <a href="{{ route('media.show', $media) }}" class="btn btn-sm btn-outline-warning w-100">
            Lihat Detail
        </a>
    </div>
</div>