<?php
// app/Models/ProfileComment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileComment extends Model
{
    protected $fillable = ['profile_user_id', 'commenter_id', 'body'];

    public function profileUser(): BelongsTo { return $this->belongsTo(User::class, 'profile_user_id'); }
    public function commenter(): BelongsTo { return $this->belongsTo(User::class, 'commenter_id'); }
}