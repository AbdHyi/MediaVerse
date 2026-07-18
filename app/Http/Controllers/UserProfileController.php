<?php
// app/Http/Controllers/UserProfileController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    public function show(User $user): View
    {
        $isOwner = auth()->check() && auth()->id() === $user->id;

        return app(DashboardController::class)->renderProfile($user, $isOwner);
    }
}