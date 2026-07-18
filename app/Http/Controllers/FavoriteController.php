<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\RedirectResponse;

class FavoriteController extends Controller
{
    public function toggle(Media $media): RedirectResponse
    {
        $existing = $media->favorites()->where('user_id', auth()->id())->first();

        if ($existing) {
            $existing->delete();
            $message = 'Dihapus dari favorite.';
        } else {
            $media->favorites()->create(['user_id' => auth()->id()]);
            $message = 'Ditambahkan ke favorite.';
        }

        return back()->with('success', $message);
    }
}