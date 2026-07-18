<?php

namespace Tests\Feature\Admin;

use App\Models\Media;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MediaUniquenessTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    /**
     * Retest bug lama: update media dengan title yang sama (title media itu
     * sendiri, tidak berubah) harus tetap lolos validasi (unique ignore diri
     * sendiri), bukan 500 / false-positive "duplikat".
     */
    public function test_updating_media_with_its_own_unchanged_title_succeeds(): void
    {
        $admin = $this->admin();
        $media = Media::factory()->create(['title' => 'Naruto Shippuden']);

        $response = $this->actingAs($admin)->put(route('admin.media.update', $media), [
            'title' => 'Naruto Shippuden',
            'type' => $media->type,
            'synopsis' => 'Update sinopsis saja.',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.media.index'));
    }

    /**
     * Update media dengan title milik media LAIN harus ditolak validasi
     * rapi (422/redirect + session error), bukan error 500.
     */
    public function test_updating_media_with_another_medias_title_is_rejected_gracefully(): void
    {
        $admin = $this->admin();
        Media::factory()->create(['title' => 'One Piece']);
        $target = Media::factory()->create(['title' => 'Bleach']);

        $response = $this->actingAs($admin)->put(route('admin.media.update', $target), [
            'title' => 'One Piece',
            'type' => $target->type,
        ]);

        $response->assertSessionHasErrors('title');
        $this->assertDatabaseHas('media', ['id' => $target->id, 'title' => 'Bleach']);
    }

    public function test_creating_media_with_duplicate_title_is_rejected(): void
    {
        $admin = $this->admin();
        Media::factory()->create(['title' => 'Attack on Titan']);

        $response = $this->actingAs($admin)->post('/admin/media', [
            'title' => 'Attack on Titan',
            'type' => 'anime',
        ]);

        $response->assertSessionHasErrors('title');
        $this->assertSame(1, Media::where('title', 'Attack on Titan')->count());
    }

    /**
     * SLUG-01 (bug baru ditemukan): dua title berbeda yang menghasilkan
     * slug sama (mis. "Naruto!" vs "Naruto?") HARUS ditolak validasi rapi,
     * bukan 500 saat INSERT karena bentrok unique constraint di kolom slug.
     */
    public function test_creating_media_with_title_that_slug_collides_is_rejected_gracefully(): void
    {
        $admin = $this->admin();
        Media::factory()->create(['title' => 'Naruto!', 'slug' => 'naruto']);

        $response = $this->actingAs($admin)->post('/admin/media', [
            'title' => 'Naruto?', // title beda, tapi Str::slug() -> "naruto" juga
            'type' => 'anime',
        ]);

        $response->assertSessionHasErrors('slug');
        $this->assertSame(1, Media::where('slug', 'naruto')->count());
    }

    public function test_updating_media_with_title_that_slug_collides_with_other_media_is_rejected(): void
    {
        $admin = $this->admin();
        Media::factory()->create(['title' => 'Naruto!', 'slug' => 'naruto']);
        $target = Media::factory()->create(['title' => 'Bleach', 'slug' => 'bleach']);

        $response = $this->actingAs($admin)->put(route('admin.media.update', $target), [
            'title' => 'Naruto?',
            'type' => $target->type,
        ]);

        $response->assertSessionHasErrors('slug');
        $this->assertDatabaseHas('media', ['id' => $target->id, 'slug' => 'bleach']);
    }

    public function test_regular_user_cannot_access_admin_media_routes(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/media');

        $response->assertForbidden();
    }

    public function test_guest_is_redirected_to_login_from_admin_media_routes(): void
    {
        $response = $this->get('/admin/media');

        $response->assertRedirect('/login');
    }
}
