<?php
namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $trending = Media::query()
            ->with(['studio', 'genres'])
            ->withAvg('reviews', 'rating')
            ->withCount('watchlists')
            ->orderByDesc('watchlists_count')
            ->orderByDesc('reviews_avg_rating')
            ->take(10)
            ->get()
            ->chunk(4); // kelompokkan 4 per slide carousel

        return view('welcome', compact('trending'));
    }
}