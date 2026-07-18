{{-- resources/views/admin/studios/index.blade.php --}}
<x-layouts.admin :title="'Kelola Studio'">
    <a href="{{ route('admin.studios.create') }}" class="btn btn-warning mb-3">+ Tambah Studio</a>

    <table class="table table-dark">
        <thead><tr><th>Nama</th><th>Jumlah Media</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach ($studios as $studio)
            <tr>
                <td>{{ $studio->name }}</td>
                <td>{{ $studio->media_count }}</td>
                <td>
                    <a href="{{ route('admin.studios.edit', $studio) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                    <form action="{{ route('admin.studios.destroy', $studio) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus studio ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $studios->links() }}
</x-layouts.admin>