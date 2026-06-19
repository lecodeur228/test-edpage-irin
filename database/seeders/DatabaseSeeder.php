<?php

namespace Database\Seeders;

use Creopse\Creopse\Database\Seeders\DatabaseSeeder as CreopseDatabaseSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CreopseDatabaseSeeder::class,
            VoltzTemplateSeeder::class,
        ]);
    }
}
