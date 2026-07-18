<x-app-layout>
    <x-slot name="header">
        <h2>{{ $title ?? 'Admin' }}</h2>
    </x-slot>

    <div class="admin-shell">
        <aside class="admin-sidebar">
            <nav class="nav flex-column">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.media.index') }}"
                   class="nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                    🎬 Kelola Media
                </a>
                <a href="{{ route('admin.genres.index') }}"
                   class="nav-link {{ request()->routeIs('admin.genres.*') ? 'active' : '' }}">
                    🏷️ Kelola Genre
                </a>
                <a href="{{ route('admin.studios.index') }}"
                   class="nav-link {{ request()->routeIs('admin.studios.*') ? 'active' : '' }}">
                    🏢 Kelola Studio
                </a>
                @if (auth()->user()->role === 'absolute_admin')
                    <a href="{{ route('admin.users.index') }}"
                       class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        👤 Kelola User
                    </a>
                @endif
            </nav>
        </aside>

        <div class="admin-content">
            {{-- Alert inline lama dihapus — sudah digantikan toast global
                 (.mv-toast) yang dipasang di layouts/app.blade.php, otomatis
                 ikut ter-load karena admin.blade.php ini dibungkus <x-app-layout>. --}}
            {{ $slot }}
        </div>
    </div>
</x-app-layout>