<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            ServiceSeeder::class,
            ProjectSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
