<x-layouts.admin :title="'Kelola Genre'">
    <form action="{{ route('admin.genres.store') }}" method="POST" class="row g-2 mb-4">
        @csrf
        <div class="col-md-4">
            <input type="text" name="name" class="form-control" placeholder="Nama genre baru">
        </div>
        <div class="col-md-2">
            <button class="btn btn-warning">Tambah</button>
        </div>
    </form>

    <table class="table table-dark">
        <thead><tr><th>Nama</th><th>Jumlah Media</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach ($genres as $genre)
            <tr>
                <td>{{ $genre->name }}</td>
                <td>{{ $genre->media_count }}</td>
                <td>
                    <form action="{{ route('admin.genres.destroy', $genre) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus genre ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $genres->links() }}
</x-layouts.admin>