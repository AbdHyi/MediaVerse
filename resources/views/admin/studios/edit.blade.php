{{-- resources/views/admin/studios/edit.blade.php --}}
<x-layouts.admin :title="'Edit Studio'">
    <form action="{{ route('admin.studios.update', $studio) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama Studio</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $studio->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description', $studio->description) }}</textarea>
        </div>
        <button class="btn btn-warning">Simpan Perubahan</button>
    </form>
</x-layouts.admin>