<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerCsmdirectionTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('csm_direction', function (Blueprint $table) { 

			$table->bigIncrements('id_direc')->unsigned();
			$table->text('code_direc');
			$table->text('lib_direc');
			$table->bigInteger('init_id')->unsigned();
			$table->bigInteger('respo_id')->unsigned();
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

		Schema::dropIfExists('csm_direction');

	}
}
