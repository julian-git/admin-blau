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
	    Schema::create('tipus_quotes', function($table) {
		    $table->increments('id');
		    $table->string('descripcio', 20);
		    $table->integer('periodicitat_mesos')->unsigned(); // every how many months
		    $table->string('primer_cop_al_any', 5);
		    $table->timestamps();
		});

	    /*
	      Each casteller has a field 'quotes_fk' that points to this table.
	      This table is seeded with one dummy entry for the 'sense quota' case,
	      but apart from that contains one row for the bank data of each casteller.
	     */	    
	    Schema::create('quotes', function($table) {
		    $table->increments('id');
		    $table->string('banc', 50);
		    // Laravel doesn't seem to allow to specify int(4),
		    // so we define the following fields as strings and validate on input
		    $table->string('codi_banc', 4)->nullable(); 
		    $table->string('oficina', 4)->nullable();
		    $table->string('digit_control', 2)->nullable();
		    $table->string('compte', 10)->nullable();
		    $table->string('BIC', 50)->nullable(); // FIXME: correct size?
		    $table->string('IBAN', 50)->nullable(); // FIXME: correct size?
		    $table->decimal('import');
		    $table->integer('tipus_quotes_fk')->unsigned();
		    $table->foreign('tipus_quotes_fk')->references('id')->on('tipus_quotes');
		    $table->timestamps();
		});

	    Schema::create('families', function($table) {
		    $table->increments('id');
		    $table->string('cognom1', 50);
		    $table->string('cognom2', 50)->nullable();
		    $table->timestamps();
		});

	    Schema::create('castellers', function($table) {
		    $table->increments('id');
		    $table->string('cognom1', 50)->index();
		    $table->string('cognom2', 50);
		    $table->string('nom', 50)->index();
		    $table->string('mot', 50)->index();
		    $table->integer('families_fk')->unsigned();
		    $table->foreign('families_fk')->references('id')->on('families');
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
		    $table->integer('quotes_fk')->unsigned()->default(1);
		    $table->foreign('quotes_fk')->references('id')->on('quotes');
		    $table->timestamps();
		});

	    Schema::create('tipus_activitats', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 50)->index();
		    $table->string('descripcio', 200);
		    $table->timestamps();
		});

	    Schema::create('activitats', function($table) {
		    $table->increments('id');
		    $table->string('titol', 50)->index();
		    $table->integer('tipus_activitats_fk')->unsigned();
		    $table->foreign('tipus_activitats_fk')->references('id')->on('tipus_activitats');
		    $table->date('data')->index();
		    $table->date('fi')->nullable();
		    $table->string('descripcio', 200)->nullable();
		    $table->string('contacte', 200)->nullable();		    
		    $table->decimal('cost_estimat')->nullable();
		    $table->decimal('cost_real')->nullable();
		    $table->timestamps();
		});

	    Schema::create('castellers_x_activitats', function($table) {
		    $table->integer('castellers_fk')->unsigned();
		    $table->integer('activitats_fk')->unsigned();
		    $table->foreign('castellers_fk')->references('id')->on('castellers');
		    $table->foreign('activitats_fk')->references('id')->on('activitats');
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
	    Schema::drop('tipus_activitats');
	    Schema::drop('castellers');
	    Schema::drop('families');
	    Schema::drop('quotes');
	    Schema::drop('tipus_quotes');
	}

}