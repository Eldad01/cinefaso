<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            FestivalSeeder::class,
            LieuSeeder::class,
            FilmSeeder::class,
            SeanceSeeder::class,
            EvenementSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
