<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidate;
use App\Models\Region;
use Faker\Factory as Faker;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $positions = ['Walikota', 'Bupati', 'Wakil Walikota', 'Wakil Bupati'];
        $parties = ['Partai A', 'Partai B', 'Partai C', 'Partai D', 'Partai E'];

        // Get all region ids
        $regionIds = Region::pluck('id')->toArray();

        // Create 100 candidates
        for ($i = 0; $i < 10; $i++) {
            $region = Region::find($faker->randomElement($regionIds));

            Candidate::create([
                'name' => $faker->name,
                'position' => $faker->randomElement($positions),
                'party' => $faker->randomElement($parties),
                'region_id' => $region->id,
                'short_bio' => $faker->paragraph,
                'full_bio' => $faker->paragraphs(3, true),
                'image_url' => $faker->imageUrl(640, 480, 'people'),
                'election_date' => $faker->dateTimeBetween('now', '+2 years'),
            ]);
        }
    }
}
