<?php

namespace Database\Seeders;

use App\Models\ApplicantCriteria;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApplicantCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteria = [
            [
                'id' => fake()->uuid(),
                'name' => 'Umum',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'UMKM / Instansi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        ApplicantCriteria::insert($criteria);
    }
}
