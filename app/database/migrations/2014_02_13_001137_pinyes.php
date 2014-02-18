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
	    Schema::create('llocs', function($table) {
		    $table->increments('id');
		    $table->string('nom', 50);
		});

	    Schema::create('tipus_actuacions', function($table) {
		    $table->increments('id');
		    $table->string('nom', 10);
		});

	    Schema::create('actuacions', function($table) {
		    $table->increments('id');
		    $table->integer('tipus_actuacions_fk')->unsigned();
		    $table->foreign('tipus_actuacions_fk')->references('id')->on('tipus_actuacions');
		    $table->date('data')->index();
		    $table->integer('llocs_fk')->unsigned();
		    $table->foreign('llocs_fk')->references('id')->on('llocs');
		});
	    
	    Schema::create('tipus_castells', function($table) {
		    $table->increments('id');
		    $table->string('nom', 10);
		});

	    Schema::create('castells', function($table) {
		    $table->increments('id');
		    $table->integer('tipus_castells_fk')->unsigned();
		    $table->foreign('tipus_castells_fk')->references('id')->on('tipus_castells');
		    $table->integer('actuacions_fk')->unsigned();
		    $table->foreign('actuacions_fk')->references('id')->on('actuacions');
		    $table->smallInteger('ordre');
		});

	    Schema::create('tipus_posicions', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 15);
		});

	    Schema::create('posicions', function($table) {
		    $table->increments('id');
		    $table->integer('tipus_castells_fk')->unsigned();
		    $table->foreign('tipus_castells_fk')->references('id')->on('tipus_castells');
		    $table->integer('tipus_posicions_fk')->unsigned();
		    $table->foreign('tipus_posicions_fk')->references('id')->on('tipus_posicions');
		    $table->string('nom', 15);
		});

	    Schema::create('pinyes', function($table) {
		    $table->increments('id');
		    $table->integer('castells_fk')->unsigned();
		    $table->foreign('castells_fk')->references('id')->on('castells');
		    $table->integer('castellers_fk')->unsigned();
		    $table->foreign('castellers_fk')->references('id')->on('castellers');
		    $table->integer('posicions_fk')->unsigned();
		    $table->foreign('posicions_fk')->references('id')->on('posicions');
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
	    Schema::drop('tipus_posicions');
	    Schema::drop('castells');
	    Schema::drop('tipus_castells');
	    Schema::drop('actuacions');
	    Schema::drop('tipus_actuacions');
	    Schema::drop('llocs');
	}

}