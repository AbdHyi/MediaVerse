<x-layouts.admin :title="'Admin Dashboard'">
    <div class="dashboard-space-bg {{ auth()->user()->role === 'absolute_admin' ? 'dashboard-space-absolute' : 'dashboard-space-admin' }}">
        <div class="row g-3 mb-4">
            <div class="col-md-4"><div class="card p-3">Total Media: {{ $stats['total_media'] }}</div></div>
            <div class="col-md-4"><div class="card p-3">Total User: {{ $stats['total_users'] }}</div></div>
            <div class="col-md-4"><div class="card p-3">Total Review: {{ $stats['total_reviews'] }}</div></div>
        </div>
        <a href="{{ route('admin.media.index') }}" class="btn btn-warning">Kelola Media</a>
        <a href="{{ route('admin.genres.index') }}" class="btn btn-outline-warning">Kelola Genre</a>
    </div>
</x-layouts.admin>