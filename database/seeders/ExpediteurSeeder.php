<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ExpediteurSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM csm_menu WHERE architecture = '/cour'");

		DB::table('csm_menu')->insert([
			['libelle_menu'=>'Expediteurs','titre_page'=>'Expediteurs',
			'controler'=>'ExpediteurController','route'=>'expediteur',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/cour/expediteur','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Ajouter un expediteur','dev_action'=>'add_expediteur',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Modifier un expediteur','dev_action'=>'update_expediteur',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Supprimer un expediteur','dev_action'=>'delete_expediteur',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter expediteur','dev_action'=>'exporter_expediteur',],
		]);

		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		$Last_menu = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		//Create
		DB::table('csm_menu')->insert([
			['libelle_menu'=>"Ajouter un expediteur",'titre_page'=>"Ajouter un expediteur",
			'controler'=>'ExpediteurController','route'=>'expediteur/create',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/cour/expediteur/create','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		//Update
		DB::table('csm_menu')->insert([
			['libelle_menu'=>"Modifier un expediteur",'titre_page'=>"Modifier un expediteur",
			'controler'=>'ExpediteurController','route'=>'expediteur/edit',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/cour/expediteur/edit','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};
