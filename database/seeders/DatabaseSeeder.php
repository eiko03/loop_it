<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Car\Models\Car;


class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([
            UserSeeder::class,
            CarSeeder::class
        ]);

    }
}
