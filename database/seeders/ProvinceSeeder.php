<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces=[
            [ 'id'=>fake()->uuid(), 'number'=>11 , 'name'=>'Aceh', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>12 , 'name'=>'Sumatera Utara', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>13 , 'name'=>'Sumatera Barat', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>14 , 'name'=>'Riau', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>15 , 'name'=>'Jambi', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>16 , 'name'=>'Sumatera Selatan', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>17 , 'name'=>'Bengkulu', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>18 , 'name'=>'Lampung', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>19 , 'name'=>'Kepulauan Bangka Belitung', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>21 , 'name'=>'Kepulauan Riau', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>31 , 'name'=>'Dki Jakarta', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>32 , 'name'=>'Jawa Barat', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>33 , 'name'=>'Jawa Tengah', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>34 , 'name'=>'Di Yogyakarta', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>35 , 'name'=>'Jawa Timur', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>36 , 'name'=>'Banten', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>51 , 'name'=>'Bali', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>52 , 'name'=>'Nusa Tenggara Barat', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>53 , 'name'=>'Nusa Tenggara Timur', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>61 , 'name'=>'Kalimantan Barat', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>62 , 'name'=>'Kalimantan Tengah', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>63 , 'name'=>'Kalimantan Selatan', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>64 , 'name'=>'Kalimantan Timur', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>65 , 'name'=>'Kalimantan Utara', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>71 , 'name'=>'Sulawesi Utara', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>72 , 'name'=>'Sulawesi Tengah', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>73 , 'name'=>'Sulawesi Selatan', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>74 , 'name'=>'Sulawesi Tenggara', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>75 , 'name'=>'Gorontalo', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>76 , 'name'=>'Sulawesi Barat', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>81 , 'name'=>'Maluku', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>82 , 'name'=>'Maluku Utara', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>91 , 'name'=>'Papua Barat', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            [ 'id'=>fake()->uuid(), 'number'=>94 , 'name'=>'Papua', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]
        ];

        Province::insert($provinces);
    }
}
