<?php

use Illuminate\Database\Migrations\Migration;

class Messages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('missatges', function($table) {
		    $table->increments('id');
		    $table->string('titol', 50);
		    $table->string('contingut', 500);
		    $table->date('data_caducitat');
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
	    Schema::drop('missatges');
	}

}