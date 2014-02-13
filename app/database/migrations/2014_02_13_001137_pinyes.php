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
	    Schema::create('castell', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 10);
		    $table->date('data');
		    $table->string('lloc', 20);
		    $table->smallInteger('ordre');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}