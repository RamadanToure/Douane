<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreerCsmexpediteurTable extends Migration {

	/**
	* Run the database .
	* Generer par generalForm (Giwu Richard - Richardtohon@gmail.com)
	* @return void
	*/

	public function up() {

		Schema::create('csm_expediteur', function (Blueprint $table) { 

			$table->bigIncrements('id_expe')->unsigned();
			$table->text('nom_expe');
			$table->text('type_expe');
			$table->text('adres_expe')->nullable();
			$table->text('email_expe');
			$table->bigInteger('init_id')->unsigned();
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

		Schema::dropIfExists('csm_expediteur');

	}
}
