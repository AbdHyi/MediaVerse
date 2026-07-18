<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Media;
use App\Models\Studio;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyMediaSeeder extends Seeder
{
    public function run(): void
    {
        $studios = collect(['Studio Ghibli', 'Marvel Studios', 'A24', 'Netflix Originals', 'Kyoto Animation'])
            ->map(fn ($name) => Studio::firstOrCreate(['name' => $name]));

        $genres = collect(['Action', 'Adventure', 'Drama', 'Comedy', 'Fantasy', 'Sci-Fi', 'Thriller', 'Romance'])
            ->map(fn ($name) => Genre::firstOrCreate(['name' => $name]));

        $titles = [
            ['title' => 'Spirited Away', 'type' => 'anime', 'year' => 2001, 'studio' => 0],
            ['title' => 'Princess Mononoke', 'type' => 'anime', 'year' => 1997, 'studio' => 0],
            ['title' => 'Inception', 'type' => 'film', 'year' => 2010, 'studio' => 1],
            ['title' => 'Avengers: Endgame', 'type' => 'film', 'year' => 2019, 'studio' => 1],
            ['title' => 'Everything Everywhere All at Once', 'type' => 'film', 'year' => 2022, 'studio' => 2],
            ['title' => 'Midsommar', 'type' => 'film', 'year' => 2019, 'studio' => 2],
            ['title' => 'Breaking Bad', 'type' => 'series', 'year' => 2008, 'studio' => 3],
            ['title' => 'Stranger Things', 'type' => 'series', 'year' => 2016, 'studio' => 3],
            ['title' => 'The Crown', 'type' => 'series', 'year' => 2016, 'studio' => 3],
            ['title' => 'Violet Evergarden', 'type' => 'anime', 'year' => 2018, 'studio' => 4],
            ['title' => 'K-On!', 'type' => 'anime', 'year' => 2009, 'studio' => 4],
            ['title' => 'A Silent Voice', 'type' => 'anime', 'year' => 2016, 'studio' => 4],
        ];

        $mediaModels = [];

        foreach ($titles as $item) {
            $media = Media::firstOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'studio_id' => $studios[$item['studio']]->id,
                    'title' => $item['title'],
                    'type' => $item['type'],
                    'synopsis' => 'Sinopsis dummy untuk ' . $item['title'] . '. Konten ini akan diganti dengan sinopsis asli.',
                    'release_year' => $item['year'],
                ]
            );

            $media->genres()->syncWithoutDetaching(
                $genres->random(rand(2, 3))->pluck('id')
            );

            $mediaModels[] = $media;
        }

        // Dummy review supaya Trending & rating punya variasi data
        $absoluteAdmin = User::where('role', 'absolute_admin')->first();

        if ($absoluteAdmin) {
            foreach ($mediaModels as $media) {
                Review::firstOrCreate(
                    ['user_id' => $absoluteAdmin->id, 'media_id' => $media->id],
                    [
                        'rating' => rand(6, 10),
                        'review_text' => 'Review dummy dari admin untuk keperluan testing tampilan rating.',
                    ]
                );
            }
        }
    }
}