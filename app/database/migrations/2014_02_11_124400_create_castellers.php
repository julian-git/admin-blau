<?php
/*
    (c) 2014 Castellers de la Vila de Gràcia
    info@cvg.cat

    This file is part of l'Admin Blau.

    L'Admin Blau is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    L'Admin Blau is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

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
		    $table->integer('quota_id_fk')->unsigned();
		    $table->foreign('quota_id_fk')->references('id')->on('quotes')->nullable();
		    $table->timestamps();
		});

	    Schema::create('families', function($table) {
		    $table->increments('id');
		    $table->string('cognom1', 50);
		    $table->string('cognom2', 50);
		    $table->timestamps();
		});

	    Schema::create('families_x_castellers', function($table) {
		    $table->integer('familia_id_fk')->unsigned();
		    $table->integer('casteller_id_fk')->unsigned();
		    $table->foreign('familia_id_fk')->references('id')->on('families');
		    $table->foreign('casteller_id_fk')->references('id')->on('castellers');
		});
	    
	    Schema::create('tipus_activitat', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 50)->index();
		    $table->string('descripcio', 200);
		});

	    Schema::create('activitats', function($table) {
		    $table->increments('id');
		    $table->string('titol', 50)->index();
		    $table->integer('tipus_fk')->unsigned();
		    $table->foreign('tipus_fk')->references('id')->on('tipus_activitat');
		    $table->date('data')->index();
		    $table->date('fi')->nullable();
		    $table->string('descripcio', 200)->nullable();
		    $table->string('contacte', 200)->nullable();		    
		    $table->decimal('cost_estimat')->nullable();
		    $table->decimal('cost_real')->nullable();
		    $table->timestamps();
		});

	    Schema::create('castellers_x_activitats', function($table) {
		    $table->integer('casteller_id_fk')->unsigned();
		    $table->integer('activitat_id_fk')->unsigned();
		    $table->foreign('casteller_id_fk')->references('id')->on('castellers');
		    $table->foreign('activitat_id_fk')->references('id')->on('activitats');
		});
	    DB::insert('insert into quotes (id, tipus, cantitat) values (?, ?, ?)', array(1, 'trimestral', 14));	

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('castellers_x_activitats');
	    Schema::drop('activitats');
	    Schema::drop('tipus_activitat');
	    Schema::drop('families_x_castellers');
	    Schema::drop('families');
	    Schema::drop('castellers');
	    Schema::drop('quotes');
	}

}