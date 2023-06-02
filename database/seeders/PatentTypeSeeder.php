<?php

namespace Database\Seeders;

use App\Models\PatentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'id' => fake()->uuid(),
                'name' => 'Paten',
                'have_origin_patent' => 0,
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'Paten Sederhana',
                'have_origin_patent' => 0,
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'Paten Pecahan',
                'have_origin_patent' => 1,
            ],
        ];

        PatentType::insert($datas);
    }
}
