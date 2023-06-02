<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'id' => fake()->uuid(),
                'name' => 'Umum',
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'UMKM / Instansi',
            ],
        ];

        Criteria::insert($datas);
    }
}
