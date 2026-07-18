<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(Request $request): View
    {

        $query = Media::query()
            ->with(['studio', 'genres'])
            ->withAvg('reviews', 'rating')
            ->withCount('watchlists');

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter tipe
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter genre
        if ($request->filled('genre')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('genres.id', $request->genre);
            });
        }

        $mediaList = $query->latest()->paginate(12)->withQueryString();
        $genres = Genre::orderBy('name')->get();

        return view('media.index', compact('mediaList', 'genres'));
    }

    public function show(Media $media): View
    {
        $media->load(['studio', 'genres', 'reviews.user']);
        $media->loadAvg('reviews', 'rating');

        $userReview = null;
        $isInWatchlist = false;
        $isInFavorite = false;

        if (auth()->check()) {
            $userReview = $media->reviews->firstWhere('user_id', auth()->id());
            $isInWatchlist = $media->watchlists()->where('user_id', auth()->id())->exists();
            $isInFavorite = $media->favorites()->where('user_id', auth()->id())->exists();
        }

        return view('media.show', compact('media', 'userReview', 'isInWatchlist', 'isInFavorite'));
    }
}