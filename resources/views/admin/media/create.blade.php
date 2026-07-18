<x-layouts.admin :title="'Tambah Media'">
    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Tipe</label>
            <select name="type" class="form-select" required>
                <option value="film">Film</option>
                <option value="series">Series</option>
                <option value="anime">Anime</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Studio</label>
            <select name="studio_id" class="form-select">
                <option value="">- Tidak ada -</option>
                @foreach ($studios as $studio)
                    <option value="{{ $studio->id }}">{{ $studio->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tahun Rilis</label>
            <input type="number" name="release_year" class="form-control" value="{{ old('release_year') }}">
        </div>
        <div class="mb-3">
            <label>Sinopsis</label>
            <textarea name="synopsis" class="form-control">{{ old('synopsis') }}</textarea>
        </div>
        <div class="mb-3">
            <label>Poster</label>
            <input type="file" name="poster" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label>Genre</label>
            @foreach ($genres as $genre)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="genres[]" value="{{ $genre->id }}" class="form-check-input">
                    <label class="form-check-label">{{ $genre->name }}</label>
                </div>
            @endforeach
        </div>
        <button class="btn btn-warning">Simpan</button>
    </form>
</x-layouts.admin>