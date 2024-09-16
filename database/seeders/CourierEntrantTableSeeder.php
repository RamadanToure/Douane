<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Expediteur;
use App\Models\Direction;
use DB;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;
use Ramsey\Uuid\Uuid;

class CourierEntrantTableSeeder extends Seeder
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
            DB::table('csm_courrier')->insert([
                'ref_cour' => $faker->name,
                'code_cour' => Uuid::uuid4(),
                'date_rece' => "2023-10-19",
                'date_limite' => "2023-10-30",
                'expe_id' => Expediteur::inRandomOrder()->first()->id_expe,
                'sujet_cour' => $faker->sentence,
                'commentaire_cour' => $faker->sentence,
                'piece_jointe_cour' => $faker->word.'.pdf',
                'type_cour' => "e",
                'statut_cour' => "ec",
                'code_check' => $faker->numberBetween(1000000, 9999999),
                'priorite_cour' => "h",
                'direc_id' => Direction::inRandomOrder()->first()->id_direc,
                'init_id' => 1,
            ]);
        }
    }
}
