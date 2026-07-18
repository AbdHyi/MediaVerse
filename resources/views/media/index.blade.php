<x-app-layout>
    <x-slot name="header"><h2>Browse Media</h2></x-slot>

    <div class="container py-4">
        <form method="GET" action="{{ route('media.index') }}" class="row g-2 mb-4">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Cari judul..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="type" class="form-select">
                    <option value="">Semua Tipe</option>
                    @foreach (['film', 'series', 'anime'] as $type)
                        <option value="{{ $type }}" @selected(request('type') === $type)>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="genre" class="form-select">
                    <option value="">Semua Genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" @selected(request('genre') == $genre->id)>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <button class="btn btn-warning w-100">Cari</button>
            </div>
        </form>

        <div class="row g-3">
            @forelse ($mediaList as $media)
                <div class="col-6 col-md-4 col-lg-3">
                    <x-media-card :media="$media" />
                </div>
            @empty
                <div class="col-12 text-center text-secondary py-5">
                    Tidak ada media ditemukan.
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $mediaList->links() }}
        </div>
    </div>
</x-app-layout>