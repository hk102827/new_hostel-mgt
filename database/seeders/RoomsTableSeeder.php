<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomsTableSeeder extends Seeder
{
    public function run(): void
    {
        Room::factory()->count(10)->create(); // 👈 this is the problem
    }
}
