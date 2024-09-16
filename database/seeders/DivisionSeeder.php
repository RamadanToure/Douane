<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DivisionSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM csm_menu WHERE architecture = '/param'");

		DB::table('csm_menu')->insert([
			['libelle_menu'=>'Liste des divisions','titre_page'=>'Liste des divisions',
			'controler'=>'DivisionController','route'=>'division',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/division','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Ajouter une division','dev_action'=>'add_division',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Modifier une division','dev_action'=>'update_division',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Supprimer une division','dev_action'=>'delete_division',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter division','dev_action'=>'exporter_division',],
		]);

		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		$Last_menu = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		//Create
		DB::table('csm_menu')->insert([
			['libelle_menu'=>"Ajouter une division",'titre_page'=>"Ajouter une division",
			'controler'=>'DivisionController','route'=>'division/create',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/division/create','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		//Update
		DB::table('csm_menu')->insert([
			['libelle_menu'=>"Modifier une division",'titre_page'=>"Modifier une division",
			'controler'=>'DivisionController','route'=>'division/edit',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/division/edit','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};
