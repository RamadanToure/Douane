<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB,Hash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;
use App\Models\Direction;

class UsersTableSeeder extends Seeder
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
            DB::table('csm_users')->insert([
                'code' => Uuid::uuid4(),
                'name' => 'Nom' . $i,
                'prenom' => 'Prénom' . $i,
                'email' => 'email' . $i . '@example.com',
                'password' => Hash::make('123'),
                'id_ini' => 1,
                'id_role' => 1,
                'init_id' => 1,
                'tel_user' => '94 xx xx xx',
                'is_active' => 1,
                'type_destina' => 'dr',
                'id_desti' => Direction::inRandomOrder()->first()->id_direc,
                'grade'=>'Grade',
                'matricule'=>$faker->name,
                'date_nais'=>$faker->dateTimeBetween('-30 years', 'now'),
                'date_embauche'=>$faker->dateTimeBetween('-10 years', 'now'),
                'telephone'=>$faker->numberBetween(10000000, 90000000),
                'echellon'=>'E1',
            ]);
        }
    }
}
