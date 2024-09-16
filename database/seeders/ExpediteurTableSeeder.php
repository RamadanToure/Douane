<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use DB;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

class ExpediteurTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 1; $i <= 20; $i++) {
            DB::table('csm_expediteur')->insert([
                'nom_expe' => $faker->name,
                'type_expe' => "pm",
                'adres_expe' => $faker->sentence,
                'email_expe' => $faker->unique()->safeEmail,
                'init_id' => 1,
            ]);
        }
    }
}
