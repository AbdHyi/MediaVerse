<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Review;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_media' => Media::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_reviews' => Review::count(),
        ];

        $recentReviews = Review::with(['user', 'media'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentReviews'));
    }
}