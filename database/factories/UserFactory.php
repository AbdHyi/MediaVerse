<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            // Di-set eksplisit (bukan cuma andalkan default kolom DB) supaya
            // object in-memory hasil factory langsung konsisten. Tanpa ini,
            // actingAs($user) di test bisa salah anggap user nonaktif karena
            // atribut 'is_active' belum ke-load ke object sebelum fresh().
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * 'role' dan 'is_active' sengaja TIDAK ada di $fillable User (lihat
     * app/Models/User.php), jadi state() biasa / create(['role' => ...])
     * akan gagal diam-diam (mass assignment guard). State di bawah ini
     * pakai forceFill() lewat afterCreating() supaya tetap tersimpan.
     */
    public function admin(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->forceFill(['role' => 'admin'])->save();
        });
    }

    public function absoluteAdmin(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->forceFill(['role' => 'absolute_admin'])->save();
        });
    }

    public function inactive(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->forceFill(['is_active' => false])->save();
        });
    }
}
