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

class Pinyes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('castell_tipus', function($table) {
		    $table->increments('id');
		    $table->string('nom', 10);
		});
	    
	    Schema::create('castells', function($table) {
		    $table->increments('id');
		    $table->integer('tipus_fk')->unsigned();
		    $table->foreign('tipus_fk')->references('id')->on('castell_tipus');
		    $table->date('data');
		    $table->string('lloc', 20);
		    $table->smallInteger('ordre');
		});

	    Schema::create('posicio_tipus', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 15);
		});

	    Schema::create('posicio', function($table) {
		    $table->increments('id');
		    $table->integer('castell_tipus_fk')->unsigned();
		    $table->foreign('castell_tipus_fk')->references('id')->on('castell_tipus');
		    $table->integer('posicio_tipus_fk')->unsigned();
		    $table->foreign('posicio_tipus_fk')->references('id')->on('posicio_tipus');
		    $table->string('nom', 15);
		});

	    Schema::create('pinya', function($table) {
		    $table->increments('id');
		    $table->integer('casteller_id_fk')->unsigned();
		    $table->foreign('casteller_id_fk')->references('id')->on('castellers');
		    $table->integer('castell_id_fk')->unsigned();
		    $table->foreign('castell_id_fk')->references('id')->on('castells');
		    $table->integer('posicio_id_fk')->unsigned();
		    $table->foreign('posicio_id_fk')->references('id')->on('posicio');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('pinya');
	    Schema::drop('posicio');
	    Schema::drop('posicio_tipus');
	    Schema::drop('castells');
	    Schema::drop('castell_tipus');
	}

}