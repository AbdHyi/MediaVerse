<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * REV-01: Rating di luar range 1-10 harus ditolak oleh validasi
     * server-side (StoreReviewRequest), mensimulasikan bypass client-side
     * validation lewat request langsung (mis. Postman/DevTools).
     */
    public function test_rating_above_max_is_rejected(): void
    {
        $user = User::factory()->create();
        $media = Media::factory()->create();

        $response = $this->actingAs($user)->post("/media/{$media->slug}/review", [
            'rating' => 11,
            'review_text' => 'Mantap tapi rating dipaksa lewat batas.',
        ]);

        $response->assertSessionHasErrors('rating');
        $this->assertDatabaseMissing('reviews', [
            'user_id' => $user->id,
            'media_id' => $media->id,
        ]);
    }

    public function test_rating_below_min_is_rejected(): void
    {
        $user = User::factory()->create();
        $media = Media::factory()->create();

        $response = $this->actingAs($user)->post("/media/{$media->slug}/review", [
            'rating' => 0,
        ]);

        $response->assertSessionHasErrors('rating');
        $this->assertDatabaseMissing('reviews', [
            'user_id' => $user->id,
            'media_id' => $media->id,
        ]);
    }

    public function test_non_integer_rating_is_rejected(): void
    {
        $user = User::factory()->create();
        $media = Media::factory()->create();

        $response = $this->actingAs($user)->post("/media/{$media->slug}/review", [
            'rating' => 7.5,
        ]);

        $response->assertSessionHasErrors('rating');
    }

    public function test_valid_rating_within_range_is_accepted(): void
    {
        $user = User::factory()->create();
        $media = Media::factory()->create();

        $response = $this->actingAs($user)->post("/media/{$media->slug}/review", [
            'rating' => 10,
            'review_text' => 'Bagus banget.',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'media_id' => $media->id,
            'rating' => 10,
        ]);
    }

    public function test_guest_cannot_submit_review(): void
    {
        $media = Media::factory()->create();

        $response = $this->post("/media/{$media->slug}/review", [
            'rating' => 8,
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('reviews', ['media_id' => $media->id]);
    }

    public function test_user_cannot_edit_or_delete_review_belonging_to_another_user(): void
    {
        $owner = User::factory()->create();
        $attacker = User::factory()->create();
        $media = Media::factory()->create();

        $review = Review::create([
            'user_id' => $owner->id,
            'media_id' => $media->id,
            'rating' => 9,
            'review_text' => 'Punya owner.',
        ]);

        // ReviewController::store pakai updateOrCreate dengan kondisi user_id
        // milik user yang sedang login, jadi attacker mencoba "edit" review
        // ini justru akan MEMBUAT review baru miliknya sendiri, bukan
        // menimpa review owner. Kita pastikan review owner tetap utuh.
        $this->actingAs($attacker)->post("/media/{$media->slug}/review", [
            'rating' => 1,
            'review_text' => 'Coba nimpa punya orang lain.',
        ]);

        $review->refresh();
        $this->assertSame(9, $review->rating);
        $this->assertSame('Punya owner.', $review->review_text);

        // destroy() juga hanya menghapus review milik user yang login
        $this->actingAs($attacker)->delete("/media/{$media->slug}/review");
        $this->assertDatabaseHas('reviews', ['id' => $review->id]);
    }
}
