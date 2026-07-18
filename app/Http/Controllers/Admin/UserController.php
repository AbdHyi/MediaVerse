<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        // Opsi B: absolute_admin difilter keluar total dari list
        $users = User::where('role', '!=', 'absolute_admin')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function updateRole(User $user): RedirectResponse
    {
        // Safety Rule: jaring pengaman kedua di server,
        // walau query index() sudah memfilter, endpoint ini tetap divalidasi
        // (mencegah manipulasi request langsung ke URL user id milik absolute_admin)
        if ($user->role === 'absolute_admin') {
            abort(403, 'Role Absolute Admin tidak dapat diubah.');
        }

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return back()->with('success', "Role {$user->name} berhasil diubah menjadi {$user->role}.");
    }

    public function toggleActive(User $user): RedirectResponse
    {
        if ($user->role === 'absolute_admin') {
            abort(403, 'Status Absolute Admin tidak dapat diubah.');
        }

        // Cegah admin menonaktifkan akunnya sendiri secara tidak sengaja
        if ($user->id === auth()->id()) {
            abort(403, 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
        }

        $user->is_active = ! $user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Akun {$user->name} berhasil {$status}.");
    }
}