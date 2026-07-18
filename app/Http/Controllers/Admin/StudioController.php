<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudioController extends Controller
{
    public function index(): View
    {
        $studios = Studio::withCount('media')->orderBy('name')->paginate(15);
        return view('admin.studios.index', compact('studios'));
    }

    public function create(): View
    {
        return view('admin.studios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:150', 'unique:studios,name'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        Studio::create($request->only('name', 'description'));

        return redirect()->route('admin.studios.index')->with('success', 'Studio berhasil ditambahkan.');
    }

    public function edit(Studio $studio): View
    {
        return view('admin.studios.edit', compact('studio'));
    }

    public function update(Request $request, Studio $studio): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:150', 'unique:studios,name,' . $studio->id],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $studio->update($request->only('name', 'description'));

        return redirect()->route('admin.studios.index')->with('success', 'Studio berhasil diperbarui.');
    }

    public function destroy(Studio $studio): RedirectResponse
    {
        $studio->delete(); // media terkait otomatis studio_id jadi NULL (sesuai ON DELETE SET NULL di migration)
        return back()->with('success', 'Studio berhasil dihapus.');
    }
}