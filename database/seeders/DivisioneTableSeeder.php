<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Service;
use DB;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

class DivisioneTableSeeder extends Seeder
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
            DB::table('csm_division')->insert([
                'code_divi' => $faker->name,
                'lib_divi' => $faker->sentence,
                'init_id' => 1,
                'id_serv' => Service::inRandomOrder()->first()->id_serv,
                'respo_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
