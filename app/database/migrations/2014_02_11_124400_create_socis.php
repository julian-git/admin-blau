<?php

use Illuminate\Database\Migrations\Migration;

class CreateSocis extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('socis', function($table) {
		    $table->increments('id');
		    $table->string('cognom1', 50);
		    $table->string('cognom2', 50);
		    $table->string('nom', 50);
		    $table->string('mot', 50);
		    $table->date('naixement');
		    $table->string('dni', 15);
		    $table->string('email', 50);
		    $table->string('direccio', 200);
		    $table->string('cp', 8);
		    $table->string('poblacio', 50);
		    $table->string('provincia', 30);
		    $table->string('telefon 1', 12);
		    $table->string('telefon 2', 12);
		    $table->string('mobil 1', 12);
		    $table->string('mobil 2', 12);
		    $table->string('twitter', 20);
		    $table->string('whatsapp', 20);
		    $table->date('alta');
		    $table->string('sexe', 1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('socis');
	}

}