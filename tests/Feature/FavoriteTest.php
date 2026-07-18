<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_media_to_favorite(): void
    {
        $user = User::factory()->create();
        $media = Media::factory()->create();

        $response = $this->actingAs($user)->post("/media/{$media->slug}/favorite");

        $response->assertRedirect();
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'media_id' => $media->id,
        ]);
    }

    public function test_toggling_favorite_twice_removes_it(): void
    {
        $user = User::factory()->create();
        $media = Media::factory()->create();

        // toggle on
        $this->actingAs($user)->post("/media/{$media->slug}/favorite");
        $this->assertDatabaseHas('favorites', ['user_id' => $user->id, 'media_id' => $media->id]);

        // toggle off
        $this->actingAs($user)->post("/media/{$media->slug}/favorite");
        $this->assertDatabaseMissing('favorites', ['user_id' => $user->id, 'media_id' => $media->id]);
    }

    public function test_favorite_does_not_create_duplicate_rows_for_same_user_media(): void
    {
        $user = User::factory()->create();
        $media = Media::factory()->create();

        $media->favorites()->create(['user_id' => $user->id]);

        // Toggle lagi -> harusnya menghapus baris yang ada, bukan menambah baris kedua
        $this->actingAs($user)->post("/media/{$media->slug}/favorite");

        $this->assertSame(0, $media->favorites()->where('user_id', $user->id)->count());
    }

    public function test_favorite_is_independent_per_user(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $media = Media::factory()->create();

        $this->actingAs($userA)->post("/media/{$media->slug}/favorite");

        $this->assertDatabaseHas('favorites', ['user_id' => $userA->id, 'media_id' => $media->id]);
        $this->assertDatabaseMissing('favorites', ['user_id' => $userB->id, 'media_id' => $media->id]);
    }

    public function test_guest_cannot_toggle_favorite(): void
    {
        $media = Media::factory()->create();

        $response = $this->post("/media/{$media->slug}/favorite");

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('favorites', ['media_id' => $media->id]);
    }
}
