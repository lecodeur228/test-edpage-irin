<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('voltz:seed', function () {
    $this->call('db:seed', ['--class' => Database\Seeders\VoltzTemplateSeeder::class]);
    $this->info('Contenu Voltz rechargé depuis database/seeders/VoltzTemplateSeeder.php');
})->purpose('Recharge le contenu Voltz (page Home, sections, menus) depuis le seeder');
