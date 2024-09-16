<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerCsmcarriereTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('csm_carriere', function (Blueprint $table) { 

			$table->bigIncrements('id_carr')->unsigned();
			$table->text('type_fonct');
			$table->bigInteger('id_fonct');
			$table->date('date_debut_carr');
			$table->date('date_fin_carr');
			$table->bigInteger('salaire_carr');
			$table->bigInteger('id_occupant')->unsigned();
			$table->bigInteger('init_id')->unsigned();
			$table->foreign('id_occupant')->references('id')->on('users')->onDelete('set null');
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

		Schema::dropIfExists('csm_carriere');

	}
}
