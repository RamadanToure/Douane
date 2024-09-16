<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Direction;
use DB;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 1; $i <= 50; $i++) {
            DB::table('csm_service')->insert([
                'code_serv' => $faker->name,
                'lib_serv' => $faker->sentence,
                'init_id' => 1,
                'id_direc' => Direction::inRandomOrder()->first()->id_direc,
                'respo_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
