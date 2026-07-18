<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessControlRegressionTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_dashboard_to_login(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertForbidden();
    }

    public function test_admin_cannot_access_absolute_admin_only_user_management(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/users');

        $response->assertForbidden();
    }

    public function test_absolute_admin_can_access_user_management(): void
    {
        $absoluteAdmin = User::factory()->create(['role' => 'absolute_admin']);

        $response = $this->actingAs($absoluteAdmin)->get('/admin/users');

        $response->assertOk();
    }

    public function test_absolute_admin_can_access_regular_admin_routes_too(): void
    {
        $absoluteAdmin = User::factory()->create(['role' => 'absolute_admin']);

        $response = $this->actingAs($absoluteAdmin)->get('/admin');

        $response->assertOk();
    }

    public function test_inactive_account_is_rejected_at_login(): void
    {
        $user = User::factory()->create([
            'is_active' => false,
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors();
    }

    /**
     * Kasus sesi lama: akun dinonaktifkan SETELAH user login. Middleware
     * 'active' / CheckRole harus menangkap ini di request berikutnya,
     * bukan cuma di titik login.
     */
    public function test_active_session_is_terminated_once_account_is_deactivated_mid_session(): void
    {
        $user = User::factory()->create(['is_active' => true]);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertOk();

        // 'is_active' sengaja tidak fillable di model User, jadi update()
        // biasa akan diam-diam gagal. forceFill() mensimulasikan apa yang
        // dilakukan Admin\UserController::toggleActive() (assignment
        // langsung ke properti, bukan mass assignment).
        $user->forceFill(['is_active' => false])->save();

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertForbidden();
        $this->assertGuest();
    }

    public function test_active_admin_session_is_terminated_once_deactivated_mid_session(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'is_active' => true]);

        $this->actingAs($admin)->get('/admin')->assertOk();

        $admin->forceFill(['is_active' => false])->save();

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertForbidden();
        $this->assertGuest();
    }
}
