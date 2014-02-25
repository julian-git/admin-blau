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

	    DB::table('tipus_quotes')
		->insert(array(array('id' => 1, 
				     'descripcio' => 'Sense Quota',
				     'periodicitat_mesos' => 0, 
				     'primer_cop_al_any' => '00-00'
				     ),
			       array('id' => 2, 
				     'descripcio' => 'Trimestral',
				     'periodicitat_mesos' => 3, 
				     'primer_cop_al_any' => '03-01'
				     ),
			       array('id' => 3, 
				      'descripcio' => 'Semestral',
				      'periodicitat_mesos' => 6, 
				      'primer_cop_al_any' => '07-01'
				     )
				));

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
		    $table->string('BIC', 12)->nullable(); 
		    $table->string('IBAN', 34)->nullable();
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

	    Schema::create('categories', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 50);
		    $table->string('comentari', 100)->nullable();
		    $table->timestamps();
		});
	    
	    DB::table('categories')
		->insert(array(array('id' => 1,
				     'tipus' => 'Casteller',
				     'created_at' => date('Y-m-d H:i:s'),
				     'updated_at' => date('Y-m-d H:i:s')
				     ),
			       array('id' => 2,
				     'tipus' => 'Canalla',
				     'created_at' => date('Y-m-d H:i:s'),
				     'updated_at' => date('Y-m-d H:i:s')
				     ),
			       array('id' => 3,
				     'tipus' => 'Nen de la colla',
				     'created_at' => date('Y-m-d H:i:s'),
				     'updated_at' => date('Y-m-d H:i:s')
				     ),
			       array('id' => 4,
				     'tipus' => 'Col·laborador',
				     'created_at' => date('Y-m-d H:i:s'),
				     'updated_at' => date('Y-m-d H:i:s')
				     ),
			       array('id' => 5,
				     'tipus' => 'Simpatitzant',
				     'created_at' => date('Y-m-d H:i:s'),
				     'updated_at' => date('Y-m-d H:i:s')
				     )
			       ));

	    Schema::create('persones', function($table) {
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
		    $table->boolean('actiu')->default(1)->index();
		    $table->integer('categories_fk')->unsigned()->default(1);
		    $table->foreign('categories_fk')->references('id')->on('categories');
		    $table->decimal('alcada-cadira');
		    $table->decimal('alcada-hombros');
		    $table->decimal('alcada-mans');
		    $table->decimal('amplada-hombros');
		    $table->decimal('circunferencia');
		    $table->timestamps();
		});

	    Schema::create('beneficiaris', function($table) {
		    $table->increments('id');
		    $table->integer('quotes_fk')->unsigned();
		    $table->foreign('quotes_fk')->references('id')->on('quotes');
		    $table->integer('persones_fk')->unsigned();
		    $table->foreign('persones_fk')->references('id')->on('persones');
		});

	    Schema::create('tipus_esdeveniments', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 50)->index();
		    $table->string('descripcio', 200);
		    $table->timestamps();
		});

	    DB::table('tipus_esdeveniments')
		->insert(array(array('id' => 1, 
				      'tipus' => 'Calçotada',
				      'descripcio' => ''
				     ),
			       array('id' => 2, 
				      'tipus' => 'Sopar',
				      'descripcio' => ''
				     )
			       ));


	    Schema::create('llocs', function($table) {
		    $table->increments('id');
		    $table->string('nom', 50);
		    $table->timestamps();
		});

	    DB::table('llocs')
		->insert(array(array('id' => 1, 
				     'nom' => 'Can Mussons'
				     ),
			       array('id' => 2, 
				     'nom' => 'Vila de Gràcia'
				     ),
			       array('id' => 3, 
				     'nom' => 'Terrassa'
				     )
			       ));


	    Schema::create('esdeveniments', function($table) {
		    $table->increments('id');
		    $table->string('titol', 50)->index();
		    $table->integer('tipus_esdeveniments_fk')->unsigned();
		    $table->foreign('tipus_esdeveniments_fk')->references('id')->on('tipus_esdeveniments');
		    $table->date('data')->index();
		    $table->date('data_fi')->nullable();
		    $table->time('hora');
		    $table->time('hora_fi')->nullable();
		    $table->string('descripcio', 200)->nullable();
		    $table->integer('llocs_fk')->unsigned();
		    $table->foreign('llocs_fk')->references('id')->on('llocs');
		    $table->string('contacte', 200)->nullable();		    
		    $table->decimal('cost_estimat')->nullable();
		    $table->decimal('cost_real')->nullable();
		    $table->timestamps();
		});

	    Schema::create('esdeveniment_persone', function($table) {
		    $table->integer('persone_id')->unsigned();
		    $table->foreign('persone_id')->references('id')->on('persones');
		    $table->integer('esdeveniment_id')->unsigned();
		    $table->foreign('esdeveniment_id')->references('id')->on('esdeveniments');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::drop('esdeveniment_persone');
	    Schema::drop('esdeveniments');
	    Schema::drop('tipus_esdeveniments');
	    Schema::drop('beneficiaris');
	    Schema::drop('llocs');
	    Schema::drop('persones');
	    Schema::drop('categories');
	    Schema::drop('families');
	    Schema::drop('quotes');
	    Schema::drop('tipus_quotes');
	}

}