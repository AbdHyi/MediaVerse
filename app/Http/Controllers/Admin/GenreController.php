<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GenreController extends Controller
{
    public function index(): View
    {
        $genres = Genre::withCount('media')->orderBy('name')->paginate(15);
        return view('admin.genres.index', compact('genres'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:genres,name'],
        ]);

        Genre::create(['name' => $request->name]);

        return back()->with('success', 'Genre berhasil ditambahkan.');
    }

    public function update(Request $request, Genre $genre): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:genres,name,' . $genre->id],
        ]);

        $genre->update(['name' => $request->name]);

        return back()->with('success', 'Genre berhasil diperbarui.');
    }

    public function destroy(Genre $genre): RedirectResponse
    {
        $genre->delete();

        return back()->with('success', 'Genre berhasil dihapus.');
    }
}