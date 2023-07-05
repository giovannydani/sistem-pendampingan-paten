<?php

namespace Database\Seeders;

use App\Models\PatentType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'id' => fake()->uuid(),
                'name' => 'Paten',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'Paten Sederhana',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        PatentType::insert($types);
    }
}
