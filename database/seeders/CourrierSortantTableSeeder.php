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

class CourrierSortantTableSeeder extends Seeder
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
            DB::table('csm_courrier_sortant')->insert([
                'ref_cour' => $faker->name,
                'code_cour' => Uuid::uuid4(),
                'date_envoi' => "2023-10-18 10:20:05",
                'dest_id' => Expediteur::inRandomOrder()->first()->id_expe,
                'sujet_cour' => $faker->sentence,
                'direc_id' => Direction::inRandomOrder()->first()->id_direc,
                'note_cour' => $faker->sentence,
                'piece_jointe' => $faker->word.'.pdf',
                'init_id' => 1,
            ]);
        }
    }
}
