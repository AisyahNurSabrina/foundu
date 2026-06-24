<?php

namespace Database\Seeders;

use App\Models\PickupPoint;
use Illuminate\Database\Seeder;

class PickupPointSeeder extends Seeder
{
    public function run(): void
    {
        $points = [
            ['name' => 'Pos Gerbang Utama', 'location' => 'Gerbang Utama Kampus'],
            ['name' => 'Pos Fakultas A', 'location' => 'Lobby Fakultas A'],
            ['name' => 'Pos Perpustakaan', 'location' => 'Lantai 1 Perpustakaan Pusat'],
        ];

        foreach ($points as $point) {
            PickupPoint::create($point);
        }
    }
}
