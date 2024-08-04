<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $this->call([
            RegionSeeder::class,
            CandidateSeeder::class,
        ]);


        User::create([
            'name' => 'Cari Pemimpin',
            'email' => 'pilkada.caripemimpin@gmail.com',
            'password' => bcrypt('secret')

        ]);
    }
}
