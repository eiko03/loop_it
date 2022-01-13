<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{

    public function run(Faker $factory)
    {
        $faker=$factory::create();
        foreach (range(0,5) as $number)
            DB::table('users')->insert([
                'name'=>$faker->name,
                'email'=>$faker->safeEmail,
                'password'=>Hash::make('123Qaw@!!9Io09ZZ'),
            ]);
    }
}
