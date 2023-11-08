<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => fake()->uuid(),
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('Hv.8S$5npaT7i3m'),
                'role' => UserRole::SUPERADMIN->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('mX6$M$sq3Hv*22R'),
                'role' => UserRole::ADMIN->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'Giovanny Dani Saputra',
                'email' => 'giovanny@gio.com',
                'password' => Hash::make('fwYe7z7S6Ks.93E'),
                'role' => UserRole::USER->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'User Satu',
                'email' => 'user1@example.com',
                'password' => Hash::make('fwYe7z7S6Ks.93F'),
                'role' => UserRole::USER->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'User Dua',
                'email' => 'user2@example.com',
                'password' => Hash::make('fwYe7z7S6Ks.93G'),
                'role' => UserRole::USER->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'User Tiga',
                'email' => 'user3@example.com',
                'password' => Hash::make('fwYe7z7S6Ks.93H'),
                'role' => UserRole::USER->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'User Empat',
                'email' => 'user4@example.com',
                'password' => Hash::make('fwYe7z7S6Ks.93I'),
                'role' => UserRole::USER->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'User Lima',
                'email' => 'user5@example.com',
                'password' => Hash::make('fwYe7z7S6Ks.93J'),
                'role' => UserRole::USER->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'User Enam',
                'email' => 'user6@example.com',
                'password' => Hash::make('fwYe7z7S6Ks.93K'),
                'role' => UserRole::USER->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'User Tujuh',
                'email' => 'user7@example.com',
                'password' => Hash::make('fwYe7z7S6Ks.93L'),
                'role' => UserRole::USER->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'User Delapan',
                'email' => 'user8@example.com',
                'password' => Hash::make('fwYe7z7S6Ks.93M'),
                'role' => UserRole::USER->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'User Sembilan',
                'email' => 'user9@example.com',
                'password' => Hash::make('fwYe7z7S6Ks.93N'),
                'role' => UserRole::USER->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => fake()->uuid(),
                'name' => 'User Sepuluh',
                'email' => 'user10@example.com',
                'password' => Hash::make('fwYe7z7S6Ks.93O'),
                'role' => UserRole::USER->value,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        
        User::insert($users);
    }
}
