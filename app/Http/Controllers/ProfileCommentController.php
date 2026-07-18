<?php
// app/Http/Controllers/ProfileCommentController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProfileCommentController extends Controller
{
    public function store(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'body' => ['required', 'string', 'max:500'],
        ]);

        $user->profileComments()->create([
            'commenter_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'Komentar terkirim.');
    }
}