<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $regions = [
            ['name' => 'Bandung', 'type' => 'Kota'],
            ['name' => 'Bogor', 'type' => 'Kota'],
            ['name' => 'Bekasi', 'type' => 'Kota'],
            ['name' => 'Depok', 'type' => 'Kota'],
            ['name' => 'Cirebon', 'type' => 'Kota'],
            ['name' => 'Tasikmalaya', 'type' => 'Kota'],
            ['name' => 'Banjar', 'type' => 'Kota'],
            ['name' => 'Bandung', 'type' => 'Kabupaten'],
            ['name' => 'Bogor', 'type' => 'Kabupaten'],
            ['name' => 'Garut', 'type' => 'Kabupaten'],
            // Tambahkan wilayah lain sesuai kebutuhan
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}
