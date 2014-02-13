<?php

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

	    Schema::create('posicio', function($table) {
		    $table->increments('id');
		    $table->integer('castell_tipus_fk')->unsigned();
		    $table->foreign('castell_tipus_fk')->references('id')->on('castell_tipus');
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
	    Schema::drop('castells');
	    Schema::drop('castell_tipus');
	}

}