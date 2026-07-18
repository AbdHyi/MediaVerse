{{-- resources/views/admin/studios/create.blade.php --}}
<x-layouts.admin :title="'Tambah Studio'">
    <form action="{{ route('admin.studios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Studio</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <button class="btn btn-warning">Simpan</button>
    </form>
</x-layouts.admin>