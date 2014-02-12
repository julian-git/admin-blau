<?php

use Illuminate\Database\Migrations\Migration;

class CreateCastellers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('quotes', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 20);
		    $table->decimal('cantitat');
		    $table->timestamps();
		});

	    Schema::create('castellers', function($table) {
		    $table->increments('id');
		    $table->string('cognom1', 50)->index();
		    $table->string('cognom2', 50);
		    $table->string('nom', 50)->index();
		    $table->string('mot', 50)->index();
		    $table->date('naixement');
		    $table->string('dni', 15);
		    $table->string('email', 50);
		    $table->string('direccio', 200);
		    $table->string('cp', 8);
		    $table->string('poblacio', 50);
		    $table->string('provincia', 30);
		    $table->string('telefon1', 12);
		    $table->string('telefon2', 12);
		    $table->string('mobil1', 12);
		    $table->string('mobil2', 12);
		    $table->string('twitter', 20);
		    $table->string('whatsapp', 20);
		    $table->date('alta')->index();
		    $table->string('sexe', 1);
		    $table->integer('quota_id')->foreign()->references('id')->on('quotes')->nullable();
		    $table->timestamps();
		});

	    Schema::create('families', function($table) {
		    $table->increments('id');
		    $table->string('cognom1', 50);
		    $table->string('cognom2', 50);
		    $table->timestamps();
		});

	    Schema::create('families_x_castellers', function($table) {
		    $table->integer('familia_id')->foreign()->references('id')->on('families');
		    $table->integer('casteller_id')->foreign()->references('id')->on('castellers');
		});
	    
	    Schema::create('tipus_activitat', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 50)->index();
		    $table->string('descripcio', 200);
		});

	    Schema::create('activitats', function($table) {
		    $table->increments('id');
		    $table->string('titol')->index();
		    $table->integer('tipus')->foreign()->references('id')->on('tipus_activitat');
		    $table->date('data')->index();
		    $table->date('fi')->nullable();
		    $table->string('descripcio', 200);
		    $table->string('contacte', 200);		    
		});

	    Schema::create('castellers_x_activitats', function($table) {
		    $table->integer('casteller_id')->foreign()->references('id')->on('castellers');
		    $table->integer('activitat_id')->foreign()->references('id')->on('activitats');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('quotes');
	    Schema::drop('castellers');
	    Schema::drop('families');
	    Schema::drop('families_x_castellers');
	    Schema::drop('tipus_activitat');
	    Schema::drop('activitats');
	    Schema::drop('castellers_x_activitats');
	}

}