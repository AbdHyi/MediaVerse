<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return $this->renderProfile(Auth::user(), isOwner: true);
    }

    public function renderProfile($profileUser, bool $isOwner): View
    {
        $watchlist = $profileUser->watchlists()->with('media')->latest()->take(3)->get();
        $favorites = $profileUser->favorites()->with('media')->latest()->get();
        $reviews = $profileUser->reviews()->with('media')->latest()->take(3)->get();
        $comments = $profileUser->profileComments()->with('commenter')->take(10)->get();

        return view('profile.show', compact('profileUser', 'isOwner', 'watchlist', 'favorites', 'reviews', 'comments'));
    }
}