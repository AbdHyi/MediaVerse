<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        $title = fake()->unique()->sentence(3);

        return [
            'studio_id' => null,
            'title' => $title,
            'slug' => Str::slug($title),
            'type' => fake()->randomElement(['film', 'series', 'anime']),
            'synopsis' => fake()->paragraph(),
            'release_year' => fake()->numberBetween(1990, (int) date('Y')),
            'poster_path' => null,
        ];
    }
}
