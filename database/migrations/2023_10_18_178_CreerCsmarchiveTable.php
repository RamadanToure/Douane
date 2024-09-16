<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerCsmarchiveTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('csm_archive', function (Blueprint $table) { 

			$table->bigIncrements('id_archive')->unsigned();
			$table->text('ref_doc');
			$table->text('sujet_doc');
			$table->bigInteger('direc_id')->unsigned();
			$table->text('type_doc');
			$table->bigInteger('init_id')->unsigned();
			$table->string('fichier_doc');
			$table->text('statut_doc');
			$table->text('code_doc');
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

		Schema::dropIfExists('csm_archive');

	}
}
