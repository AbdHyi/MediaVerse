<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Media $media): RedirectResponse
    {
        $media->reviews()->updateOrCreate(
            ['user_id' => auth()->id()], // kondisi pencarian: 1 review per user per media
            [
                'rating' => $request->rating,
                'review_text' => $request->review_text,
            ]
        );

        return back()->with('success', 'Review berhasil disimpan.');
    }

    public function destroy(Media $media): RedirectResponse
    {
        $media->reviews()->where('user_id', auth()->id())->delete();

        return back()->with('success', 'Review berhasil dihapus.');
    }
}