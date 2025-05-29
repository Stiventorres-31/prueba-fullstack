<?php

namespace Database\Seeders;

use App\Models\Visit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Visit::create([
            "name" => "Chadia Orozco",
            "email" => "chadia@gmail.com",
            'latitude' => "10.9896632",
            'longitude' => "-74.7700224",
            "user_id" => 1
        ]);
    }
}
