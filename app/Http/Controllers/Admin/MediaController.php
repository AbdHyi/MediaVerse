<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMediaRequest;
use App\Http\Requests\Admin\UpdateMediaRequest;
use App\Models\Genre;
use App\Models\Media;
use App\Models\Studio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(): View
    {
        $mediaList = Media::with('studio')->latest()->paginate(15);
        return view('admin.media.index', compact('mediaList'));
    }

    public function create(): View
    {
        $studios = Studio::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();
        return view('admin.media.create', compact('studios', 'genres'));
    }

    public function store(StoreMediaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);

        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        $media = Media::create($data);
        $media->genres()->sync($request->input('genres', []));

        return redirect()->route('admin.media.index')->with('success', 'Media berhasil ditambahkan.');
    }

    public function edit(Media $media): View
    {
        $studios = Studio::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();
        $selectedGenres = $media->genres->pluck('id')->toArray();

        return view('admin.media.edit', compact('media', 'studios', 'genres', 'selectedGenres'));
    }

    public function update(UpdateMediaRequest $request, Media $media): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);

        if ($request->hasFile('poster')) {
            if ($media->poster_path) {
                Storage::disk('public')->delete($media->poster_path);
            }
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        $media->update($data);
        $media->genres()->sync($request->input('genres', []));

        return redirect()->route('admin.media.index')->with('success', 'Media berhasil diperbarui.');
    }

    public function destroy(Media $media): RedirectResponse
    {
        if ($media->poster_path) {
            Storage::disk('public')->delete($media->poster_path);
        }

        $media->delete();

        return redirect()->route('admin.media.index')->with('success', 'Media berhasil dihapus.');
    }
}