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
		    $table->string('tipus', 25);
		    $table->string('comentari', 100)->nullable();
		    $table->timestamps();
		});
	    
	    Schema::create('rols', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 25);
		    $table->integer('nivell_permis')->unsigned();
		    $table->string('comentari', 100)->nullable();
		});

        Schema::create('tipus_quotes', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 25);
		    $table->string('comentari', 100)->nullable();
		    $table->integer('periodicitat_mesos')->unsigned(); // every how many months
		    $table->timestamps();
		});

	    Schema::create('persones', function($table) {
		    $table->increments('id');
		    $table->timestamps();
            //Dades CVG
		    $table->integer('numero_soci')->unsigned()->nullable();
		    $table->date('data_alta')->index()->nullable();
		    $table->date('data_baixa')->index()->nullable();
		    $table->boolean('actiu')->default(1)->index();
		    $table->boolean('rebre_sms')->default(1);
		    $table->boolean('rebre_mail')->default(1);
		    $table->string('comentari', 200)->nullable();
		    $table->integer('categories_fk')->unsigned()->default(1);
		    $table->foreign('categories_fk')->references('id')->on('categories');
            //Dades personals
		    $table->string('nom', 50)->index();
		    $table->string('cognom1', 50)->index();
		    $table->string('cognom2', 50)->nullable();
		    $table->string('mot', 50)->unique()->index()->nullable();
		    $table->string('dni', 15)->nullable();
		    $table->date('naixement')->nullable();
		    $table->string('sexe', 1);
            //Adreça postal
		    $table->string('direccio', 200)->nullable();
		    $table->string('cp', 8)->nullable();
		    $table->string('poblacio', 50)->nullable();
		    $table->string('provincia', 30)->nullable();
		    $table->string('pais', 30)->nullable();
            //Dades de contacte
		    $table->string('email', 50)->nullable();
		    $table->string('telefon', 12)->nullable();
		    $table->string('mobil', 12)->nullable();
            //Dades financeres
		    $table->string('iban', 34)->nullable();
            //Dades d'accés a l'aplicació
		    $table->string('password', 64)->nullable();
		    $table->integer('rols_fk')->unsigned()->default(1);
		    $table->foreign('rols_fk')->references('id')->on('rols');
            //Dades físiques
		    $table->decimal('alcada-cadira')->default(0);
		    $table->decimal('alcada-hombros')->default(0);
		    $table->decimal('alcada-mans')->default(0);
		    $table->decimal('amplada-hombros')->default(0);
		    $table->decimal('circunferencia')->default(0);
		});

	    Schema::create('families', function($table) {
		    $table->increments('id');
		    $table->string('nom', 50);
		    $table->timestamps();
		});

   	    Schema::create('familie_persone', function($table) {
		    $table->increments('id');
		    $table->integer('persone_id')->unsigned();
		    $table->foreign('persone_id')->references('id')->on('persones');
		    $table->integer('familie_id')->unsigned();
		    $table->foreign('familie_id')->references('id')->on('families');
		    $table->boolean('es_responsable')->default(0);
		    $table->timestamps();
		});

	    Schema::create('quotes', function($table) {
		    $table->increments('id');
		    $table->integer('tipus_quotes_fk')->unsigned();
		    $table->foreign('tipus_quotes_fk')->references('id')->on('tipus_quotes');
		    $table->integer('id_responsables_fk')->unsigned();
		    $table->foreign('id_responsables_fk')->references('id')->on('persones');
		    $table->decimal('import')->default(0);
		    $table->boolean('activa')->default(1);
		});
		    
	    CreateCastellers::fillBasicData();
	    CreateCastellers::otherTablesForNextReleases();
	}
	
	public function fillBasicData()
	{
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
				     'tipus' => 'Simpatitzant',
				     'created_at' => date('Y-m-d H:i:s'),
				     'updated_at' => date('Y-m-d H:i:s')
				     )
			       ));

	    DB::table('rols')
		->insert(array(array('id' => 1, 
				     'tipus' => 'Sense permisos',
				     'nivell_permis' => 0
				     ),
			     array('id' => 2,
				     'tipus' => 'Accés bàsic',
				     'nivell_permis' => 1
				     ),
			     array('id' => 3,
				     'tipus' => 'Responsable família',
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

	    DB::table('tipus_quotes')
		->insert(array(array('id' => 1, 
				     'tipus' => 'Sense quota',
				     'periodicitat_mesos' => 0,
				     'created_at' => date('Y-m-d H:i:s'),
				     'updated_at' => date('Y-m-d H:i:s')
				     ),
			       array('id' => 2,
				     'tipus' => 'Trimestral',
				     'periodicitat_mesos' => 3,
				     'created_at' => date('Y-m-d H:i:s'),
				     'updated_at' => date('Y-m-d H:i:s')
				     ),
			       array('id' => 3,
				     'tipus' => 'Semestral',
				     'periodicitat_mesos' => 6,
				     'created_at' => date('Y-m-d H:i:s'),
				     'updated_at' => date('Y-m-d H:i:s')
				     ),
			       array('id' => 4,
				     'tipus' => 'Anual',
				     'periodicitat_mesos' => 12,
				     'created_at' => date('Y-m-d H:i:s'),
				     'updated_at' => date('Y-m-d H:i:s')
                     ),
			       ));
	}

	private function otherTablesForNextReleases()
	{
	    Schema::create('tipus_esdeveniments', function($table) {
		    $table->increments('id');
		    $table->string('tipus', 50)->index();
		    $table->string('descripcio', 200);
		    $table->timestamps();
		});

	    Schema::create('llocs', function($table) {
		    $table->increments('id');
		    $table->string('nom', 50);
		    $table->timestamps();
		});

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
	    Schema::dropIfExists('esdeveniment_persone');
	    Schema::dropIfExists('esdeveniments');
	    Schema::dropIfExists('tipus_esdeveniments');
	    Schema::dropIfExists('llocs');
	    Schema::dropIfExists('beneficiaris');
	    Schema::dropIfExists('quotes');
	    Schema::dropIfExists('familie_persone');
	    Schema::dropIfExists('families');
	    Schema::dropIfExists('persones');
	    Schema::dropIfExists('tipus_quotes');
	    Schema::dropIfExists('rols');
	    Schema::dropIfExists('categories');
	}

}