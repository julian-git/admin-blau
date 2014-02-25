<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		
		foreach(['castell_persone',
			 'actuacion_persone',
			 'esdeveniment_persone',
			 'beneficiaris',
			 'persones',
			 'quotes',
			 'castells',
			 'actuacions',
			 'families',
			 'esdeveniments'
			 ] as $table)
		{
		    DB::table($table)->delete();
		}

		foreach(['QuotesSeeder',
			 'FamiliesSeeder',
			 'PersonesSeeder',
			 'BeneficiarisSeeder',
			 'EsdevenimentsSeeder',

			 'ActuacionsSeeder',
			 'CastellsSeeder',
			 'CastellPersoneSeeder',
			 'EsdevenimentPersoneSeeder',
			 'ActuacionPersoneSeeder',

			 'MissatgesSeeder'
			 ] as $seeder)
		{
		    $this->call($seeder);
		}
	}

}

class QuotesSeeder extends Seeder {

    public function run() {
	Quote::create(array('id' => 1, 
			    'banc' => 'sense quota', 
			    'tipus_quotes_fk' => 1));

	Quote::create(array('id' => 2, 
			    'banc' => 'La Caixa',
			    'codi_banc' => '1111',
			    'oficina' => '2222',
			    'digit_control' => '33',
			    'compte' => '1234567890',
			    'import' => '12.34',
			    'tipus_quotes_fk' => 2));

	Quote::create(array('id' => 3, 
			    'banc' => 'Caixa de Catalunya',
			    'codi_banc' => '5555',
			    'oficina' => '6666',
			    'digit_control' => '77',
			    'compte' => '8901234567',
			    'import' => '56.78',
			    'tipus_quotes_fk' => 3));
    }

}

class FamiliesSeeder extends Seeder {
    
    public function run() {
	DB::table('families')->delete();

	Familie::create(array('id' => 1,
			      'cognom1' => 'García'));

	Familie::create(array('id' => 2,
			      'cognom1' => 'López'));
    }
}

class PersonesSeeder extends Seeder {

    public function run() {
	DB::table('persones')->delete();
	Persone::create(array('id' => 1, 
			      'cognom1' => 'García', 
			      'cognom2' => 'González',
			      'nom' => 'Josep Maria',
			      'mot' => 'Pep',
			      'families_fk' => 1,
			      'naixement' => '1980-10-03',
			      'dni' => '12345678K',
			      'email' => 'jmg@hotmail.com',
			      'sexe' => 'H',
			      'quotes_fk' => 2));

	Persone::create(array('id' => 2, 
			      'cognom1' => 'López', 
			      'cognom2' => 'García',
			      'nom' => 'Joana',
			      'mot' => 'Pepa',
			      'families_fk' => 2,
			      'naixement' => '1979-11-04',
			      'dni' => '87654321J',
			      'email' => 'jgl@gmail.com',
			      'sexe' => 'D',
			      'quotes_fk' => 3));

	Persone::create(array('id' => 3, 
			      'cognom1' => 'Terç', 
			      'cognom2' => 'Patufet',
			      'nom' => 'Marta',
			      'mot' => 'Patufeta',
			      'families_fk' => 1,
			      'naixement' => '1973-12-04',
			      'dni' => '78563412J',
			      'email' => 'marta@patufeta.org',
			      'sexe' => 'D',
			      'quotes_fk' => 1));

    }
}

class BeneficiarisSeeder extends Seeder {

    public function run() {
	DB::table('beneficiaris')->delete();
	
	DB::table('beneficiaris')
	    ->insert(array(array('id' => 1,
				 'quotes_fk' => 2,
				 'persones_fk' => 1
				 ),
			   array('id' => 2,
				 'quotes_fk' => 2,
				 'persones_fk' => 3
				 ),
			   array('id' => 3,
				 'quotes_fk' => 3,
				 'persones_fk' => 2
				 )
			   ));
    }
}

class EsdevenimentsSeeder extends Seeder {

    public function run() {
	DB::table('esdeveniments')->delete();

	Esdeveniment::create(array('id' => 1, 
				   'titol' => 'Calçotada febrer',
				   'tipus_esdeveniments_fk' => 1,
				   'data' => '2014-02-20',
				   'hora' => '12:00',
				   'llocs_fk' => 1
				   ));

	Esdeveniment::create(array('id' => 2, 
				   'titol' => 'Sopar Festa Major',
				   'tipus_esdeveniments_fk' => 2,
				   'data' => '2014-08-20',
				   'hora' => '12:00',
				   'llocs_fk' => 2
				      ));
    }
}

class ActuacionsSeeder extends Seeder {

    public function run() {
	DB::table('actuacions')->delete();

	Actuacion::create(array('id' => 1, 
				'titol' => 'Foguerons',
				'tipus_actuacions_fk' => '2',
				'data' => '2014-02-05',
				'llocs_fk' => '1',
				'placa_o_assaig' => 'P'
			   ));

	Actuacion::create(array('id' => 2, 
				'titol' => 'Festa Major de Terrassa',
				'tipus_actuacions_fk' => '2',
				'data' => '2014-06-08',
				'llocs_fk' => '2',
				'placa_o_assaig' => 'P'
			   ));

	Actuacion::create(array('id' => 3, 
				'titol' => 'Assaig de folres',
				'tipus_actuacions_fk' => '1',
				'data' => '2014-06-05',
				'llocs_fk' => '1',
				'placa_o_assaig' => 'P'
			   ));
    }
}


class CastellsSeeder extends Seeder {

    public function run() {
	DB::table('castells')->delete();

	Castell::create(array('id' => 1, 
			      'tipus_castells_fk' => 19, // 3de8
			      'actuacion_id' => 2,
			      'ordre_a_placa' => '1',
			      'resultat' => ''
			   ));

	Castell::create(array('id' => 2, 
			      'tipus_castells_fk' => 9, // 2de8f
			      'actuacion_id' => 2,
			      'ordre_a_placa' => '2',
			      'resultat' => ''
			   ));

	Castell::create(array('id' => 3, 
			      'tipus_castells_fk' => 133, // p4
			      'actuacion_id' => 2,
			      'ordre_a_placa' => '2',
			      'resultat' => ''
			   ));

	Castell::create(array('id' => 4, 
			      'tipus_castells_fk' => 41, // 5de7
			      'actuacion_id' => 3,
			      'ordre_a_placa' => '1',
			      'resultat' => ''
			   ));

	Castell::create(array('id' => 5, 
			      'tipus_castells_fk' => 55, // 7de8
			      'actuacion_id' => 3,
			      'ordre_a_placa' => '2',
			      'resultat' => ''
			   ));

	Castell::create(array('id' => 6, 
			      'tipus_castells_fk' => 137, // p6
			      'actuacion_id' => 3,
			      'ordre_a_placa' => '2',
			      'resultat' => ''
			   ));

	Castell::create(array('id' => 7, 
			      'tipus_castells_fk' => 5, // 2de7
			      'actuacion_id' => 3,
			      'ordre_a_placa' => '2',
			      'resultat' => ''
			   ));
    }
}

class CastellPersoneSeeder extends Seeder {

    public function run() {
	DB::table('castell_persone')->delete();
	
	DB::table('castell_persone')->insert(array('persone_id' => 1,
						     'castell_id'   => 1));

	DB::table('castell_persone')->insert(array('persone_id' => 1,
						     'castell_id'   => 2));

	DB::table('castell_persone')->insert(array('persone_id' => 1,
						     'castell_id'   => 3));

	DB::table('castell_persone')->insert(array('persone_id' => 1,
						     'castell_id'   => 4));

	DB::table('castell_persone')->insert(array('persone_id' => 1,
						     'castell_id'   => 5));

	DB::table('castell_persone')->insert(array('persone_id' => 1,
						     'castell_id'   => 6));

	DB::table('castell_persone')->insert(array('persone_id' => 2,
						     'castell_id'   => 1));

	DB::table('castell_persone')->insert(array('persone_id' => 2,
						     'castell_id'   => 2));

	DB::table('castell_persone')->insert(array('persone_id' => 2,
						     'castell_id'   => 3));

    }
}

class ActuacionPersoneSeeder extends Seeder {

    public function run() {
	DB::table('actuacion_persone')->delete();
	
	DB::table('actuacion_persone')->insert(array('persone_id' => 1,
						     'actuacion_id'   => 1));

	DB::table('actuacion_persone')->insert(array('persone_id' => 1,
						     'actuacion_id'   => 2));

	DB::table('actuacion_persone')->insert(array('persone_id' => 1,
						     'actuacion_id'   => 3));

	DB::table('actuacion_persone')->insert(array('persone_id' => 2,
						     'actuacion_id'   => 1));

	DB::table('actuacion_persone')->insert(array('persone_id' => 2,
						     'actuacion_id'   => 2));
    }
}

class EsdevenimentPersoneSeeder extends Seeder {

    public function run() {
	DB::table('esdeveniment_persone')->delete();
	
	DB::table('esdeveniment_persone')->insert(array('persone_id' => 1,
							'esdeveniment_id'   => 1));

	DB::table('esdeveniment_persone')->insert(array('persone_id' => 1,
							'esdeveniment_id'   => 2));

	DB::table('esdeveniment_persone')->insert(array('persone_id' => 2,
							'esdeveniment_id'   => 1));
    }
}

class MissatgesSeeder extends Seeder {

    public function run() {
	DB::table('missatges')->delete();

	Missatge::create(array('id' => 1,
			       'titol' => 'Proper assaig de folres',
			       'contingut' => 'Suarem!!',
			       'data' => date('Y-m-d', strtotime('next friday')),
			       'llocs_fk' => 1
			       ));

	Missatge::create(array('id' => 2,
			       'titol' => 'Propera Actuació',
			       'contingut' => 'Actuarem a Terrassa!!',
			       'data' => date('Y-m-d', strtotime('next sunday')),
			       'llocs_fk' => 3
			       ));
    }
}