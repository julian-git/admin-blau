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
	    Schema::create('tipus_actuacions', function($table) {
		    $table->increments('id');
		    $table->string('nom', 50);
		    $table->timestamps();
		});

	    Schema::create('actuacions', function($table) {
		    $table->increments('id');
		    $table->string('titol', 50);
		    $table->integer('tipus_actuacions_fk')->unsigned();
		    $table->foreign('tipus_actuacions_fk')->references('id')->on('tipus_actuacions');
		    $table->date('data')->index();
		    $table->integer('llocs_fk')->unsigned();
		    $table->foreign('llocs_fk')->references('id')->on('llocs');
		    $table->string('placa_o_assaig', 1);
		    $table->timestamps();
		});
	    
	    Schema::create('tipus_castells', function($table) {
		    $table->increments('id');
		    $table->string('nom', 12)->index();
		    $table->integer('pinya_necessaria')->unsigned();
		    $table->timestamps();
		});

	    Schema::create('castells', function($table) {
		    $table->increments('id');
		    $table->integer('tipus_castells_fk')->unsigned();
		    $table->foreign('tipus_castells_fk')->references('id')->on('tipus_castells');
		    $table->integer('actuacions_fk')->unsigned();
		    $table->foreign('actuacions_fk')->references('id')->on('actuacions');
		    $table->smallInteger('ordre_a_placa')->nullable();
		    $table->string('resultat', 3)->nullable();
		    $table->timestamps();
		});

	    Schema::create('castellers_castells', function($table) {
		    $table->integer('castellers_fk')->unsigned();
		    $table->integer('castells_fk')->unsigned();
		    $table->foreign('castellers_fk')->references('id')->on('castellers');
		    $table->foreign('castells_fk')->references('id')->on('castells');
		});
 
	    Schema::create('posicions', function($table) {
		    $table->increments('id');
		    $table->integer('tipus_castells_fk')->unsigned();
		    $table->foreign('tipus_castells_fk')->references('id')->on('tipus_castells');
		    $table->string('tipus_posicio', 12);
		    $table->string('nom', 50);
		    $table->decimal('origin');
		    $table->decimal('x');
		    $table->decimal('y');
		    $table->decimal('d');
		    $table->decimal('alpha');
		    $table->timestamps();
		});

	    Schema::create('pinyes', function($table) {
		    $table->increments('id');
		    $table->integer('castells_fk')->unsigned();
		    $table->foreign('castells_fk')->references('id')->on('castells');
		    $table->integer('castellers_fk')->unsigned();
		    $table->foreign('castellers_fk')->references('id')->on('castellers');
		    $table->integer('posicions_fk')->unsigned();
		    $table->foreign('posicions_fk')->references('id')->on('posicions');
		    $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('pinyes');
	    Schema::drop('posicions');
	    Schema::drop('castellers_castells');
	    Schema::drop('castells');
	    Schema::drop('tipus_castells');
	    Schema::drop('actuacions');
	    Schema::drop('tipus_actuacions');
	}

}