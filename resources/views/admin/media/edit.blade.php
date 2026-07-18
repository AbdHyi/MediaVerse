<x-layouts.admin :title="'Edit Media'">
    <form action="{{ route('admin.media.update', $media) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $media->title) }}" required>
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Tipe</label>
            <select name="type" class="form-select" required>
                <option value="film" @selected(old('type', $media->type) === 'film')>Film</option>
                <option value="series" @selected(old('type', $media->type) === 'series')>Series</option>
                <option value="anime" @selected(old('type', $media->type) === 'anime')>Anime</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Studio</label>
            <select name="studio_id" class="form-select">
                <option value="">- Tidak ada -</option>
                @foreach ($studios as $studio)
                    <option value="{{ $studio->id }}" @selected(old('studio_id', $media->studio_id) == $studio->id)>
                        {{ $studio->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tahun Rilis</label>
            <input type="number" name="release_year" class="form-control" value="{{ old('release_year', $media->release_year) }}">
        </div>
        <div class="mb-3">
            <label>Sinopsis</label>
            <textarea name="synopsis" class="form-control">{{ old('synopsis', $media->synopsis) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Poster</label>
            @if ($media->poster_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$media->poster_path) }}" width="100" class="rounded">
                    <p class="text-secondary small">Poster saat ini (upload baru untuk mengganti)</p>
                </div>
            @endif
            <input type="file" name="poster" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label>Genre</label>
            @foreach ($genres as $genre)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="genres[]" value="{{ $genre->id }}" class="form-check-input"
                           @checked(in_array($genre->id, $selectedGenres))>
                    <label class="form-check-label">{{ $genre->name }}</label>
                </div>
            @endforeach
        </div>
        <button class="btn btn-warning">Simpan Perubahan</button>
    </form>
</x-layouts.admin>