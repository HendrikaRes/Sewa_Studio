<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('studios')->insert([
            [
                'name' => 'Studio A',
                'description' => 'Studio yang nyaman dengan fasilitas lengkap.',
                'facilities' => 'WiFi, AC, Projector',
                'price_per_hour' => 200000,
                'image_path' => 'images/studio_a.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Studio B',
                'description' => 'Cocok untuk rekaman musik.',
                'facilities' => 'Microphone, Mixer, Speaker',
                'price_per_hour' => 150000,
                'image_path' => 'images/studio_b.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}