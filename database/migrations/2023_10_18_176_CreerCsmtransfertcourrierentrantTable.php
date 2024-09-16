<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerCsmtransfertcourrierentrantTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('csm_transfert_courrierentrant', function (Blueprint $table) { 

			$table->bigIncrements('id_trce')->unsigned();
			$table->text('type_destina');
			$table->bigInteger('id_desti');
			$table->text('note_trce')->nullable();
			$table->text('etat_trce');
			$table->text('en_copie')->nullable();
			$table->bigInteger('id_initi')->unsigned();
			$table->bigInteger('courier_id')->unsigned();
			$table->foreign('id_initi')->references('id')->on('users')->onDelete('set null');
			$table->foreign('courier_id')->references('id_cour')->on('csm_courrier')->onDelete('set null');
			$table->timestamps();
		});
	}



	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function down() {

		Schema::dropIfExists('csm_transfert_courrierentrant');

	}
}
