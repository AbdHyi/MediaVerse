<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationDuplicateEmailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * AUTH-02: Register dengan email yang sudah dipakai harus ditolak
     * dengan validation error rapi (422 redirect back + session error),
     * BUKAN error 500, dan tidak boleh membuat user baru / login otomatis.
     */
    public function test_registration_with_duplicate_email_is_rejected_gracefully(): void
    {
        User::factory()->create([
            'email' => 'sudah-ada@example.com',
        ]);

        $response = $this->post('/register', [
            'name' => 'User Baru',
            'email' => 'sudah-ada@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Harus redirect back dengan validation error, bukan 500
        $response->assertSessionHasErrors('email');
        $response->assertStatus(302);

        // Tidak boleh membuat user kedua dengan email yang sama
        $this->assertSame(1, User::where('email', 'sudah-ada@example.com')->count());

        // Tidak boleh ter-login otomatis
        $this->assertGuest();
    }

    public function test_registration_with_duplicate_email_case_insensitive(): void
    {
        // Rule 'lowercase' pada RegisteredUserController akan menolak email
        // yang mengandung huruf kapital sama sekali (bukan menormalkan),
        // jadi ini sekaligus memastikan tidak ada error 500 untuk kasus ini.
        User::factory()->create([
            'email' => 'kapital@example.com',
        ]);

        $response = $this->post('/register', [
            'name' => 'User Baru',
            'email' => 'KAPITAL@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertSame(1, User::where('email', 'kapital@example.com')->count());
    }
}
