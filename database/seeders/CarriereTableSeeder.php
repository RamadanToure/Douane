<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Expediteur;
use App\Models\Direction;
use App\Models\Service;
use App\Models\Division;
use DB;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

class CarriereTableSeeder extends Seeder
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
            $dateDebut = $faker->dateTimeBetween('-5 years', 'now'); 
            $dateFin = $faker->dateTimeBetween($dateDebut, 'now'); 
            $type = $faker->randomElement(['dr', 'se', 'di']);
            if($type == 'dr'){
                $fonct = Direction::inRandomOrder()->first()->id_direc;
            }else if($type == 'se'){
                $fonct = Service::inRandomOrder()->first()->id_serv;
            }else if($type == 'di'){
                $fonct = Division::inRandomOrder()->first()->id_divi;
            }
            DB::table('csm_carriere')->insert([
                'type_fonct' => $type,
                'id_fonct' => $fonct,
                'date_debut_carr' => $dateDebut,
                'date_fin_carr' => $dateFin,
                'id_occupant' => User::inRandomOrder()->first()->id,
                'salaire_carr' => $faker->numberBetween(300000, 800000),
                'init_id' => 1,
            ]);
        }
    }
}
