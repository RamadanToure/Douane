<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ArchiveSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM csm_menu WHERE architecture = '/archive'");

		DB::table('csm_menu')->insert([
			['libelle_menu'=>'Archive','titre_page'=>'Archive',
			'controler'=>'ArchiveController','route'=>'archive',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/archive/archive','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Ajouter archive','dev_action'=>'add_archive',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Modifier archive','dev_action'=>'update_archive',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Supprimer archive','dev_action'=>'delete_archive',],
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter archive','dev_action'=>'exporter_archive',],
		]);

		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		$Last_menu = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		//Create
		DB::table('csm_menu')->insert([
			['libelle_menu'=>'Ajouter une archive','titre_page'=>'Ajout de Archive',
			'controler'=>'ArchiveController','route'=>'archive/create',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/archive/archive/create','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
		//Update
		DB::table('csm_menu')->insert([
			['libelle_menu'=>'Modifier une archive','titre_page'=>'Modification de Archive',
			'controler'=>'ArchiveController','route'=>'archive/edit',
			'topmenu_id'=>$Last_menu[0]->id,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/archive/archive/edit','elmt_menu'=>'non',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};
