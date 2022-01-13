<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CarSeeder extends Seeder
{

    public function run(Faker $factory)
    {
        $faker=$factory::create();
        foreach (range(0,50) as $number)
            DB::table('cars')->insert([
                'model'=>$faker->iban,
                'brand'=>$faker->slug,
            ]);
    }
}
