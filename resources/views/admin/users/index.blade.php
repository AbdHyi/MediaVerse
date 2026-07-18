<x-layouts.admin :title="'Kelola User'">
    <table class="table table-dark">
        <thead>
            <tr><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge bg-{{ $user->role === 'admin' ? 'warning text-dark' : 'secondary' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td>
                    <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Ubah role {{ $user->name }} menjadi {{ $user->role === 'admin' ? 'User' : 'Admin' }}?')">
                        @csrf @method('PUT')
                        <button class="btn btn-sm btn-outline-warning">
                            {{ $user->role === 'admin' ? 'Jadikan User' : 'Jadikan Admin' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.users.toggleStatus', $user) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }} akun {{ $user->name }}?')">
                        @csrf @method('PUT')
                        <button class="btn btn-sm btn-outline-{{ $user->is_active ? 'danger' : 'success' }}">
                            {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</x-layouts.admin>