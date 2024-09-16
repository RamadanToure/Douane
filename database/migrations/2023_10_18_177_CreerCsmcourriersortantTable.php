<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerCsmcourriersortantTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('csm_courrier_sortant', function (Blueprint $table) { 

			$table->bigIncrements('id_cours')->unsigned();
			$table->text('ref_cour');
			$table->dateTime('date_envoi');
			$table->bigInteger('dest_id')->unsigned();
			$table->text('sujet_cour');
			$table->bigInteger('direc_id')->unsigned();
			$table->text('code_cour');
			$table->string('piece_jointe');
			$table->bigInteger('init_id');
			$table->longText('note_cour')->nullable();
			$table->foreign('dest_id')->references('id_expe')->on('csm_expediteur')->onDelete('set null');
			$table->foreign('direc_id')->references('id_direc')->on('csm_direction')->onDelete('set null');
			$table->foreign('init_id')->references('id')->on('users')->onDelete('set null');
			$table->timestamps();
		});
	}



	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function down() {

		Schema::dropIfExists('csm_courrier_sortant');

	}
}
