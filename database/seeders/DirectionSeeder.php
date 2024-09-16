<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DirectionSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM csm_menu WHERE architecture = '/param'");

		DB::table('csm_menu')->insert([
			['libelle_menu'=>'Liste des directions','titre_page'=>'Liste des directions',
			'controler'=>'DirectionController','route'=>'direction',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/direction','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Ajouter une direction','dev_action'=>'add_direction',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Modifier une direction','dev_action'=>'update_direction',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Supprimer une direction','dev_action'=>'delete_direction',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter direction','dev_action'=>'exporter_direction',],
		]);

		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		$Last_menu = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		//Create
		DB::table('csm_menu')->insert([
			['libelle_menu'=>"Ajouter une direction",'titre_page'=>"Ajouter une direction",
			'controler'=>'DirectionController','route'=>'direction/create',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/direction/create','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		//Update
		DB::table('csm_menu')->insert([
			['libelle_menu'=>"Modifier une direction",'titre_page'=>"Modifier une direction",
			'controler'=>'DirectionController','route'=>'direction/edit',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/direction/edit','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};
