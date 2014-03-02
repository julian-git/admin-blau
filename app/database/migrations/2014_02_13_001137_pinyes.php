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

$castell_list = array();

function insert_results_impl($nom, $pinya)
{
    global $castell_list;
    $castell_list[$nom] = $pinya;
    $castell_list[$nom . 'c'] = $pinya;
    $castell_list['i' . $nom] = $pinya;
    $castell_list['id' . $nom] = $pinya;
}

function insert_results($i, $j)  // $i de $j
{
    $pinya = 5 * $i; // baix, contrafort, agulla, 2 crosses
    $n_cordons = $j; // tants cordons com diu la alçada
    $pinya += 2 * $n_cordons; // mans i vents
    for ($quesito = 1; $quesito <= $n_cordons; $quesito++)
    {
	$pinya += 2 * $i * $quesito;
    }

    $pinya += $i * $j; // el tronc; una mica sobreestimat, pero ens hem deixat els taps

    $nom = ($i == 1) 
	? "p$j" 
	: $i . 'de' . $j;

    insert_results_impl($nom, $pinya);
}

function seed_tipus_castells()
{
    for ($i=2; $i<8; $i++) 
    {
	if ($i==6) continue;
	for ($j=5; $j<10; $j++)
	    {
		if ($i==2 && $j==9) continue;
		insert_results($i, $j);
	    }
    }

    for ($i=4; $i<7; $i++)
    {
	insert_results(1, $i);
    }

    foreach(array('p7f',
	     '2de8f',
	     '2de9fm',
	     '3de9f',
	     '4de9f',
	     '5de9f',
	     '7de9f',
	     '9de9f') as $extra)
    {
	insert_results_impl($extra, 300);
    }

    global $castell_list;
    ksort($castell_list);
    foreach($castell_list as $c => $pinya)
    {
	DB::table('tipus_castells')->insert(array('nom' => $c,
						  'pinya_necessaria' => $pinya,
						  'created_at' => date('Y-m-d H:i:s'),
						  'updated_at' => date('Y-m-d H:i:s')
						  ));
    }
}

function seed_posicions()
{
    DB::table('posicions')
	->insert(array(array('id' => 1, 
			     'tipus_castells_fk' => 2,
			     'tipus_posicio' => 'Baix',
			     'nom' => 'BaixRengla'
			     ),
		       array('id' => 2, 
			     'tipus_castells_fk' => 2,
			     'tipus_posicio' => 'Baix',
			     'nom' => 'BaixPlena'
			     ),
		       array('id' => 3, 
			     'tipus_castells_fk' => 2,
			     'tipus_posicio' => 'Baix',
			     'nom' => 'BaixBuida'
			     ),
		       array('id' => 4, 
			     'tipus_castells_fk' => 2,
			     'tipus_posicio' => 'Crossa',
			     'nom' => 'CrossaDretaBaixRengla'
			     ),
		       array('id' => 5, 
			     'tipus_castells_fk' => 2,
			     'tipus_posicio' => 'Crossa',
			     'nom' => 'CrossaEsqBaixRengla'
			     ),
		       array('id' => 6, 
			     'tipus_castells_fk' => 2,
			     'tipus_posicio' => 'Crossa',
			     'nom' => 'CrossaDretaBaixPlena'
			     ),
		       array('id' => 7, 
			     'tipus_castells_fk' => 2,
			     'tipus_posicio' => 'Crossa',
			     'nom' => 'CrossaEsqBaixPlena'
			     ),
		       array('id' => 8, 
			     'tipus_castells_fk' => 2,
			     'tipus_posicio' => 'Crossa',
			     'nom' => 'CrossaDretaBaixBuida'
			     ),
		       array('id' => 9, 
			     'tipus_castells_fk' => 2,
			     'tipus_posicio' => 'Crossa',
			     'nom' => 'CrossaEsqBaixBuida'
			     )
		       ));
}

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

	    DB::table('tipus_actuacions')
		->insert(array(array('id' => 1, 
				     'nom' => 'Assaig'
				     ),
			       array('id' => 2, 
				     'nom' => 'Actuació regular'
				     ),
			       array('id' => 3, 
				     'nom' => 'Concurs'
				     )
			       ));

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
	    
	    seed_tipus_castells();


	    Schema::create('castells', function($table) {
		    $table->increments('id');
		    $table->integer('tipus_castells_fk')->unsigned();
		    $table->foreign('tipus_castells_fk')->references('id')->on('tipus_castells');
		    $table->integer('actuacion_id')->unsigned();
		    $table->foreign('actuacion_id')->references('id')->on('actuacions');
		    $table->smallInteger('ordre_a_placa')->nullable();
		    $table->string('resultat', 3)->nullable();
		    $table->timestamps();
		});

	    Schema::create('castell_persone', function($table) {
		    $table->integer('persone_id')->unsigned();
		    $table->foreign('persone_id')->references('id')->on('persones');
		    $table->integer('castell_id')->unsigned();
		    $table->foreign('castell_id')->references('id')->on('castells');
		});

	    Schema::create('actuacion_persone', function($table) {
		    $table->integer('persone_id')->unsigned();
		    $table->foreign('persone_id')->references('id')->on('persones');
		    $table->integer('actuacion_id')->unsigned();
		    $table->foreign('actuacion_id')->references('id')->on('actuacions');
		});
 
	    Schema::create('posicions', function($table) {
		    $table->increments('id');
		    $table->integer('tipus_castells_fk')->unsigned();
		    $table->foreign('tipus_castells_fk')->references('id')->on('tipus_castells');
		    $table->string('tipus_posicio', 12);
		    $table->string('nom', 50);
		    $table->decimal('origin_x')->default(0);
		    $table->decimal('origin_y')->default(0);
		    $table->decimal('x')->default(0);
		    $table->decimal('y')->default(0);
		    $table->decimal('d')->default(0);
		    $table->decimal('alpha')->default(0);
		    $table->timestamps();
		});

	    seed_posicions();

	    Schema::create('pinyes', function($table) {
		    $table->increments('id');
		    $table->integer('castells_fk')->unsigned();
		    $table->foreign('castells_fk')->references('id')->on('castells');
		    $table->integer('persones_fk')->unsigned();
		    $table->foreign('persones_fk')->references('id')->on('persones');
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
	    Schema::drop('castell_persone');
	    Schema::drop('actuacion_persone');
	    Schema::drop('castells');
	    Schema::drop('tipus_castells');
	    Schema::drop('actuacions');
	    Schema::drop('tipus_actuacions');
	}

}