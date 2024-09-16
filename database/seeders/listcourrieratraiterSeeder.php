<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class listcourrieratraiterSeeder extends Seeder {

	/**
	* Giwu Services (E-mail: giwudev@gmail.com)
	* Code Generer by Giwu 
	*/


	public function run() {

		$topid = DB::select("SELECT id_menu  FROM csm_menu WHERE architecture = '/param'");

		DB::table('csm_menu')->insert([
			['libelle_menu'=>'Courrier a traiter','titre_page'=>'Courrier a traiter',
			'controler'=>'listcourrieratraiterController','route'=>'listcourrieratraiter',
			'topmenu_id'=>$topid[0]->id_menu,'user_id'=>'1',
			'menu_icon'=>'ri-bill-line','num_ordre'=>'1',
			'architecture'=>'/param/listcourrieratraiter','elmt_menu'=>'oui',
			],
		]);
		$ok = DB::select('SELECT MAX(id_menu) as id FROM csm_menu');
		DB::table('csm_action_acces')->insert([
			['id_menu'=> $ok[0]->id,'libelle_action'=>'Exporter listcourrieratraiter','dev_action'=>'exporter_listcourrieratraiter',],
		]);

		DB::table('csm_role_acces')->insert([
			['id_menu'=> $ok[0]->id,'role_id'=>'1','statut_role'=>'1',],
		]);
	}
};
