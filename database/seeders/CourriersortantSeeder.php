<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CourriersortantSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM csm_menu WHERE architecture = '/cour'");

		DB::table('csm_menu')->insert([
			['libelle_menu'=>'Courriersortant','titre_page'=>'Courriersortant',
			'controler'=>'CourriersortantController','route'=>'courriersortant',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/cour/courriersortant','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Ajouter courriersortant','dev_action'=>'add_courriersortant',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Modifier courriersortant','dev_action'=>'update_courriersortant',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Supprimer courriersortant','dev_action'=>'delete_courriersortant',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter courriersortant','dev_action'=>'exporter_courriersortant',],
		]);

		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		$Last_menu = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		//Create
		DB::table('csm_menu')->insert([
			['libelle_menu'=>'Ajouter un courrier sortant','titre_page'=>'Ajout de Courriersortant',
			'controler'=>'CourriersortantController','route'=>'courriersortant/create',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/cour/courriersortant/create','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		//Update
		DB::table('csm_menu')->insert([
			['libelle_menu'=>'Modifier un courrier sortant','titre_page'=>'Modification de Courriersortant',
			'controler'=>'CourriersortantController','route'=>'courriersortant/edit',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/cour/courriersortant/edit','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};
