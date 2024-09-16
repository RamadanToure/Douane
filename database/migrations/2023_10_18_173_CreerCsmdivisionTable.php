<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerCsmdivisionTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('csm_division', function (Blueprint $table) { 

			$table->bigIncrements('id_divi')->unsigned();
			$table->text('code_divi');
			$table->text('lib_divi');
			$table->bigInteger('id_serv')->unsigned();
			$table->bigInteger('init_id')->unsigned();
			$table->bigInteger('respo_id')->unsigned();
			$table->foreign('id_serv')->references('id_serv')->on('csm_service')->onDelete('set null');
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

		Schema::dropIfExists('csm_division');

	}
}
