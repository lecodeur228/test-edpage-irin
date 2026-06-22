<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Creopse fournit admin, utilisateur et structure de base.
     * VoltzTemplateSeeder injecte tout le contenu du site (Home, About, menus).
     */
    public function run(): void
    {
        $this->call([
            \Creopse\Creopse\Database\Seeders\DatabaseSeeder::class,
            VoltzTemplateSeeder::class,
        ]);
    }
}
