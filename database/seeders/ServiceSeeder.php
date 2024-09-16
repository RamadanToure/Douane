<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ServiceSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM csm_menu WHERE architecture = '/param'");

		DB::table('csm_menu')->insert([
			['libelle_menu'=>'Liste des services','titre_page'=>'Liste des services',
			'controler'=>'ServiceController','route'=>'service',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/service','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Ajouter un service','dev_action'=>'add_service',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Modifier un service','dev_action'=>'update_service',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Supprimer un service','dev_action'=>'delete_service',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter service','dev_action'=>'exporter_service',],
		]);

		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		$Last_menu = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		//Create
		DB::table('csm_menu')->insert([
			['libelle_menu'=>"Ajouter un service",'titre_page'=>"Ajouter un service",
			'controler'=>'ServiceController','route'=>'service/create',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/service/create','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		//Update
		DB::table('csm_menu')->insert([
			['libelle_menu'=>"Modifier un service",'titre_page'=>"Modifier un service",
			'controler'=>'ServiceController','route'=>'service/edit',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/service/edit','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};
