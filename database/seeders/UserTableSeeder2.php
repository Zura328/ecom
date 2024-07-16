<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserTableSeeder2 extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Seed 1 admin
        DB::table('users')->insert([
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'prefix' => 'Mr.',
            'first_name' => 'Admin',
            'middle_name' => '',
            'last_name' => 'User',
            'gender' => 'Male',
            'date_of_birth' => '1980-01-01',
            'phone_number' => '1234567890',
        ]);

        // Seed 50 customers
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'email' => $faker->unique()->safeEmail,
                'role' => 'customer',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'prefix' => $faker->randomElement(['Mr.', 'Ms.', 'Mrs.']),
                'first_name' => $faker->firstName,
                'middle_name' => $faker->lastName,
                'last_name' => $faker->lastName,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'date_of_birth' => $faker->date(),
                'phone_number' => $faker->phoneNumber,
            ]);
        }

        // Seed 5 delivery guys
        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'email' => $faker->unique()->safeEmail,
                'role' => 'delivery',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'prefix' => $faker->randomElement(['Mr.', 'Ms.', 'Mrs.']),
                'first_name' => $faker->firstName,
                'middle_name' => $faker->lastName,
                'last_name' => $faker->lastName,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'date_of_birth' => $faker->date(),
                'phone_number' => $faker->phoneNumber,
            ]);
        }

        // Seed 5 employees
        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'email' => $faker->unique()->safeEmail,
                'role' => 'employee',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'prefix' => $faker->randomElement(['Mr.', 'Ms.', 'Mrs.']),
                'first_name' => $faker->firstName,
                'middle_name' => $faker->lastName,
                'last_name' => $faker->lastName,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'date_of_birth' => $faker->date(),
                'phone_number' => $faker->phoneNumber,
            ]);
        }
    }
}