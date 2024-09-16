<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerCsmcourrierTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('csm_courrier', function (Blueprint $table) { 

			$table->bigIncrements('id_cour')->unsigned();
			$table->text('ref_cour');
			$table->date('date_rece');
			$table->bigInteger('expe_id')->unsigned();
			$table->text('sujet_cour');
			$table->text('type_cour');
			$table->text('statut_cour');
			$table->text('priorite_cour');
			$table->bigInteger('direc_id')->unsigned();
			$table->date('date_limite')->nullable();
			$table->longText('commentaire_cour');
			$table->string('piece_jointe_cour');
			$table->bigInteger('init_id')->unsigned();
			$table->text('code_cour');
			$table->foreign('expe_id')->references('id_expe')->on('csm_expediteur')->onDelete('set null');
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

		Schema::dropIfExists('csm_courrier');

	}
}
