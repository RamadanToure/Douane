<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CsmserviceSeeder extends Seeder {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function run() {

		DB::table('csm_service')->insert([
		//
			['code_serv'=>'test','lib_serv'=>'test','id_direc'=>0,'init_id'=>0,'respo_id'=>1,],
			['code_serv'=>'test','lib_serv'=>'test','id_direc'=>0,'init_id'=>0,'respo_id'=>1,],
			['code_serv'=>'test','lib_serv'=>'test','id_direc'=>0,'init_id'=>0,'respo_id'=>1,],
			['code_serv'=>'test','lib_serv'=>'test','id_direc'=>0,'init_id'=>0,'respo_id'=>1,],
			['code_serv'=>'test','lib_serv'=>'test','id_direc'=>0,'init_id'=>0,'respo_id'=>1,],
		]);
	}

};
