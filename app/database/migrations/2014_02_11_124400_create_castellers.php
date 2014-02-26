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

	    Schema::create('rols', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 20);
		    $table->integer('nivell_permis')->unsigned();
		    $table->string('comentari', 200)->nullable();
		});

	    DB::table('rols')
		->insert(array(array('id' => 1, 
				     'tipus' => 'Sense Permisos',
				     'nivell_permis' => 0
				     ),
			       array('id' => 2,
				     'tipus' => 'Casteller actiu',
				     'nivell_permis' => 1
				     ),
			       array('id' => 3,
				     'tipus' => 'Ressponsable Família',
				     'nivell_permis' => 2
				     ),
			       array('id' => 4,
				     'tipus' => 'Administrador',
				     'nivell_permis' => 3
				     ),
			       array('id' => 5,
				     'tipus' => 'Super',
				     'nivell_permis' => 4
				     )
			       ));

	    Schema::create('persones', function($table) {
		    $table->increments('id');
		    $table->integer('numero_soci')->unsigned()->nullable();
		    $table->string('nom', 50)->index();
		    $table->string('cognom1', 50)->index();
		    $table->string('cognom2', 50);
		    $table->string('mot', 50)->unique()->index();
		    $table->string('dni', 15);
		    $table->date('naixement');
		    $table->string('email', 50);
		    $table->string('direccio', 200);
		    $table->string('cp', 8);
		    $table->string('poblacio', 50);
		    $table->string('provincia', 30);
		    $table->string('pais', 30)->default('Espanya');
		    $table->string('telefon', 12);
		    $table->string('mobil', 12);
		    $table->string('sexe', 1);
		    $table->date('alta')->index();
		    $table->boolean('actiu')->default(1)->index();
		    $table->integer('categories_fk')->unsigned()->default(1);
		    $table->foreign('categories_fk')->references('id')->on('categories');
		    $table->integer('rols_fk')->unsigned()->default(2);
		    $table->foreign('rols_fk')->references('id')->on('rols');
		    $table->string('usuari', 30)->nullable();
		    $table->string('password', 64)->nullable();
		    $table->boolean('rebre_sms')->default(1);
		    $table->boolean('rebre_mail')->default(1);
		    $table->string('comentari', 200)->nullable();
		    $table->string('bic', 12)->nullable(); 
		    $table->string('iban', 34)->nullable();

		    $table->decimal('alcada-cadira')->default(0);
		    $table->decimal('alcada-hombros')->default(0);
		    $table->decimal('alcada-mans')->default(0);
		    $table->decimal('amplada-hombros')->default(0);
		    $table->decimal('circunferencia')->default(0);
		    $table->timestamps();
		});

	    /*
	      Each casteller has a field 'quotes_fk' that points to this table.
	      This table is seeded with one dummy entry for the 'sense quota' case,
	      but apart from that contains one row for the bank data of each casteller.
	     */	    
	    Schema::create('quotes', function($table) {
		    $table->increments('id');
		    $table->integer('periodicitat_mesos')->unsigned(); // every how many months
		    $table->decimal('import')->default(0);
		    $table->integer('id_responsables_fk')->unsigned();
		    $table->foreign('id_responsables_fk')->references('id')->on('persones');
		    $table->timestamps();
		});

	    Schema::create('beneficiaris', function($table) {
		    $table->increments('id');
		    $table->integer('quote_id')->unsigned();
		    $table->foreign('quote_id')->references('id')->on('quotes');
		    $table->integer('persone_id')->unsigned();
		    $table->foreign('persone_id')->references('id')->on('persones');
		});

	    Schema::create('families', function($table) {
		    $table->increments('id');
		    $table->string('nom', 50);
		    $table->boolean('activa')->default(1);

		    // FIXME: cal una taula auxiliar per les camps següents

		    $table->integer('persona_membre_fk')->unsigned();
		    $table->foreign('persona_membre_fk')->references('id')->on('persones');
		    $table->integer('persona_responsable_fk')->unsigned();
		    $table->foreign('persona_responsable_fk')->references('id')->on('persones');
		    $table->timestamps();
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
	    Schema::drop('quotes');
	    Schema::drop('families');
	    Schema::drop('persones');
	    Schema::drop('rols');
	    Schema::drop('categories');
	}

}