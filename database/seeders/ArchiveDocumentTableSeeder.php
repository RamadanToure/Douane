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

class ArchiveDocumentTableSeeder extends Seeder
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
            DB::table('csm_archive')->insert([
                'ref_doc' => $faker->name,
                'sujet_doc' => $faker->sentence,
                'direc_id' => Direction::inRandomOrder()->first()->id_direc,
                'type_doc' => 'att',
                'statut_doc' => 'pri',
                'code_doc' => Uuid::uuid4(),
                'fichier_doc' => $faker->word.'.pdf',
                'init_id' => 1,
            ]);
        }
    }
}
