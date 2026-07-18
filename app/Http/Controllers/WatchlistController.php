<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\RedirectResponse;

class WatchlistController extends Controller
{
    public function toggle(Media $media): RedirectResponse
    {
        $existing = $media->watchlists()->where('user_id', auth()->id())->first();

        if ($existing) {
            $existing->delete();
            $message = 'Dihapus dari watchlist.';
        } else {
            $media->watchlists()->create(['user_id' => auth()->id()]);
            $message = 'Ditambahkan ke watchlist.';
        }

        return back()->with('success', $message);
    }
}