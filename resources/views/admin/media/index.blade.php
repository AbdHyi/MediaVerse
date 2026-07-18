<x-layouts.admin :title="'Kelola Media'">
    <a href="{{ route('admin.media.create') }}" class="btn btn-warning mb-3">+ Tambah Media</a>

    <table class="table table-dark">
        <thead><tr><th>Judul</th><th>Tipe</th><th>Studio</th><th>Tahun</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach ($mediaList as $media)
            <tr>
                <td>{{ $media->title }}</td>
                <td>{{ ucfirst($media->type) }}</td>
                <td>{{ $media->studio?->name ?? '-' }}</td>
                <td>{{ $media->release_year }}</td>
                <td>
                    <a href="{{ route('admin.media.edit', $media) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                    <form action="{{ route('admin.media.destroy', $media) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus media ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $mediaList->links() }}
</x-layouts.admin>