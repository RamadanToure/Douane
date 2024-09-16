<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use DB;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

class DirectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('csm_direction')->insert([
                'code_direc' => $faker->name,
                'lib_direc' => $faker->sentence,
                'init_id' => 1,
                'respo_id' => User::inRandomOrder()->first()->id,
            ]);
        }

    }
}
