<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerCsmserviceTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('csm_service', function (Blueprint $table) { 

			$table->bigIncrements('id_serv')->unsigned();
			$table->text('code_serv');
			$table->text('lib_serv');
			$table->bigInteger('id_direc')->unsigned();
			$table->bigInteger('init_id')->unsigned();
			$table->bigInteger('respo_id')->unsigned();
			$table->foreign('id_direc')->references('id_direc')->on('csm_direction')->onDelete('set null');
			$table->foreign('init_id')->references('id')->on('users')->onDelete('set null');
			$table->foreign('respo_id')->references('id')->on('users')->onDelete('set null');
			$table->timestamps();
		});
	}



	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function down() {

		Schema::dropIfExists('csm_service');

	}
}
