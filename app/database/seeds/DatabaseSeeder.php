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
		
		foreach(array('castell_persone',
			      'actuacion_persone',
			      'esdeveniment_persone',
			      'familie_membres',
			      'familie_responsables',
			      'rebuts',
			      'beneficiaris',
			      'quotes',
			      'persones',
			      'castells',
			      'actuacions',
			      'families',
			      'esdeveniments',
			      'tipus_esdeveniments',
			      'missatges',
			      'llocs'
			 ) as $table)
		{
		    DB::table($table)->delete();
		}

		foreach(array(

                     //Core
                     'PersonesSeeder',
                     'FamiliesSeeder',
                     'FamilieMembresSeeder',
		     'FamilieResponsablesSeeder',
                     'QuotesSeeder',
                     'BeneficiarisSeeder',
		     'RebutsSeeder',

                     //Esdeveniments
                     'TipusEsdevenimentsSeeder',
                     'LlocsSeeder',
                     'EsdevenimentsSeeder',
                     'EsdevenimentPersoneSeeder',

                     //Actuacions
                     'ActuacionsSeeder',
                     'CastellsSeeder',
                     'CastellPersoneSeeder',
                     'ActuacionPersoneSeeder',

                     //Missatges
                     'MissatgesSeeder'
                     ) as $seeder)
		{
		    $this->call($seeder);
		}
	}
}

//Core

class PersonesSeeder extends Seeder {
    public function run() {
	DB::table('persones')->delete();
	Persone::create(array('id' => 1, 
			      'numero_soci' => 1001,
			      'data_alta' => '2001-03-05',
			      'data_baixa' => '2009-03-05',
			      'actiu' => 0,
			      'cognom1' => 'García', 
			      'cognom2' => 'González',
			      'nom' => 'Josep Maria',
			      'mot' => 'Pep',
			      'naixement' => '1980-10-03',
			      'dni' => '12345678K',
			      'email' => 'jmg@hotmail.com',
			      'sexe' => 'H',
			      'direccio' => 'Carrer Blau Marí',
			      'cp' => '28035',
			      'poblacio' => 'Barcelona',
			      'provincia' => 'Barcelona',
			      'pais' => 'Espanya',
			      'telefon' => '93 111 22 33',
			      'mobil' => '605 554 232',
			      'rebre_sms' => 1,
			      'rebre_mail' => 0,
			      'iban' => 'ES07657657',
			      'bic' => 'CAHMMMYYY'
			      ));

	Persone::create(array('id' => 2, 
			      'numero_soci' => 1002,
			      'data_alta' => '2003-04-06',
			      'cognom1' => 'López', 
			      'cognom2' => 'García',
			      'nom' => 'Joana',
			      'mot' => 'Pepa',
			      'naixement' => '1979-11-04',
			      'dni' => '87654321J',
			      'email' => 'jgl@gmail.com',
			      'sexe' => 'D',
			      'rebre_sms' => 0,
			      'rebre_mail' => 0,
			      'actiu' => 1,
			      'direccio' => 'Carrer Alzina 4',
			      'cp' => '28034',
			      'poblacio' => 'Barcelona',
			      'provincia' => 'Barcelona',
			      'pais' => 'Espanya',
			      'telefon' => '93 444 55 66',
			      'mobil' => '605 776 443',
			      'rebre_sms' => 0,
			      'rebre_mail' => 1,
			      'iban' => 'ES034343422',
			      'bic' => 'CAHMMMXXX'
			      ));

	Persone::create(array('id' => 3, 
			      'numero_soci' => 1003,
			      'data_alta' => '2008-03-05',
			      'actiu' => 1,
			      'cognom1' => 'Terç', 
			      'cognom2' => 'Patufet',
			      'nom' => 'Marta',
			      'mot' => 'Patufeta',
			      'naixement' => '1973-12-04',
			      'dni' => '78563412J',
			      'email' => 'marta@patufeta.org',
			      'sexe' => 'D',
			      'direccio' => 'Carrer Gran de Gràcia, 54',
			      'cp' => '28032',
			      'poblacio' => 'Barcelona',
			      'provincia' => 'Barcelona',
			      'pais' => 'Espanya',
			      'telefon' => '93 000 44 55',
			      'mobil' => '605 222 333',
			      'rebre_sms' => 1,
			      'rebre_mail' => 1,
			      'iban' => 'ES0213123123',
			      'bic' => 'CAHMMMZZZ'
			      ));

    }
}

class FamiliesSeeder extends Seeder {
    public function run() {
	DB::table('families')->delete();

	Familie::create(array('id' => 1,
			      'nom' => 'García',
			      ));

	Familie::create(array('id' => 2,
			      'nom' => 'López',
			      ));
    }
}

class FamilieMembresSeeder extends Seeder {
    public function run() {
    $table_name='familie_membres';
	DB::table($table_name)->delete();

	DB::table($table_name)->insert(array(array(
						   'id' => 1,
						   'persone_id' => '3',
						   'familie_id' => '1'
						   )
					     ));
    }
}

class FamilieResponsablesSeeder extends Seeder {
    public function run() {
    $table_name='familie_responsables';
	DB::table($table_name)->delete();

	DB::table($table_name)->insert(array(array(
						   'id' => 1,
                                                  'persone_id' => '1',
                                                  'familie_id' => '1'
                                                  ),
                                            array(
                                                  'id' => 2,
                                                  'persone_id' => '2',
                                                  'familie_id' => '2'
						  )
					     ));
    }
}

class QuotesSeeder extends Seeder {

    public function run() {
	Quote::create(array('id' => 1, 
			    'tipus_quotes_fk' => 1,
			    'id_responsables_fk' => 2,
			    'import' => 0,
			    'activa' => 0,
			    'comentari' => 'Comentari 1'
			    ));

	Quote::create(array('id' => 2, 
			    'tipus_quotes_fk' => 2,
			    'id_responsables_fk' => 1,
			    'import' => 12,
			    'activa' => 1, 
			    'comentari' => 'Comentari 2'
			    ));

	Quote::create(array('id' => 3, 
			    'tipus_quotes_fk' => 3,
			    'id_responsables_fk' => 2,
			    'import' => 120,
			    'activa' => 1, 
			    'comentari' => 'Comentari 3'
			    ));
    }
}


class BeneficiarisSeeder extends Seeder {
    public function run() {
	DB::table('beneficiaris')->delete();
	
	DB::table('beneficiaris')
	    ->insert(array(array(
				 'quote_id' => 2,
				 'persone_id' => 1
				 ),
			   array(
				 'quote_id' => 2,
				 'persone_id' => 3
				 ),
			   array(
				 'quote_id' => 1,
				 'persone_id' => 2
				 )
			   ));
    }
}

class RebutsSeeder extends Seeder {
    public function run() {
	DB::table('rebuts')
	    ->insert(array(
			   array(
				 'id' => 1,
				 'quote_id' => 1,
				 'data' => '2013-06-01',
				 'import' => 23.50,
				 'estat' => 'Pagat'
				 ),
			   array(
				 'id' => 2,
				 'quote_id' => 1,
				 'data' => '2014-01-01',
				 'import' => 100.50,
				 'estat' => 'Retornat'
				 ),
			   array(
				 'id' => 3,
				 'quote_id' => 2,
				 'data' => '2013-06-01',
				 'import' => 23.50,
				 'estat' => 'Pagat'
				 )
			   ));
    }
}

//Esdeveniments
class TipusEsdevenimentsSeeder extends Seeder {
    public function run() {
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
    }
}

class LlocsSeeder extends Seeder {
    public function run() {
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

//Actuacions
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

//Missatges
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