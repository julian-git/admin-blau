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
		
		foreach(['castellers',
			 'quotes',
			 'castells',
			 'actuacions',
			 'tipus_quotes',
			 'families',
			 'esdeveniments',
			 'tipus_esdeveniments',
			 'llocs',
			 'tipus_actuacions',
			 'posicions',
			 'tipus_castells'
			 ] as $table)
		{
		    DB::table($table)->delete();
		}

		foreach(['TipusQuoteSeeder',
			 'QuotesSeeder',
			 'FamiliesSeeder',
			 'CastellersSeeder',
			 'LlocsSeeder',
			 'TipusEsdevenimentsSeeder',
			 'EsdevenimentsSeeder',

			 'TipusActuacionsSeeder',
			 'ActuacionsSeeder',
			 'TipusCastellsSeeder',
			 'CastellsSeeder',
			 'PosicionsSeeder',

			 'MissatgesSeeder'
			 ] as $seeder)
		{
		    $this->call($seeder);
		}
	}

}

class TipusQuoteSeeder extends Seeder {

    public function run() {
	TipusQuote::create(array('id' => 1, 
				 'descripcio' => 'Sense Quota',
				 'periodicitat_mesos' => 0, 
				 'primer_cop_al_any' => '00-00'));

	TipusQuote::create(array('id' => 2, 
				 'descripcio' => 'Trimestral',
				 'periodicitat_mesos' => 3, 
				 'primer_cop_al_any' => '03-01'));

	TipusQuote::create(array('id' => 3, 
				 'descripcio' => 'Semestral',
				 'periodicitat_mesos' => 6, 
				 'primer_cop_al_any' => '07-01'));
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

class CastellersSeeder extends Seeder {

    public function run() {
	DB::table('castellers')->delete();
	Casteller::create(array('id' => 1, 
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

	Casteller::create(array('id' => 2, 
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

    }
}

class LlocsSeeder extends Seeder {

    public function run() {
	DB::table('llocs')->delete();

	Lloc::create(array('id' => 1, 
			   'nom' => 'Vila de Gràcia'
			   ));

	Lloc::create(array('id' => 2, 
			   'nom' => 'Terrassa'
			   ));
    }
}

class TipusEsdevenimentsSeeder extends Seeder {

    public function run() {
	DB::table('tipus_esdeveniments')->delete();

	TipusEsdeveniment::create(array('id' => 1, 
				      'tipus' => 'Calçotada',
				      'descripcio' => ''
				      ));

	TipusEsdeveniment::create(array('id' => 2, 
				      'tipus' => 'Sopar',
				      'descripcio' => ''
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

class TipusActuacionsSeeder extends Seeder {

    public function run() {
	DB::table('tipus_actuacions')->delete();

	TipusActuacion::create(array('id' => 1, 
				     'nom' => 'Assaig'
				     ));

	TipusActuacion::create(array('id' => 2, 
				     'nom' => 'Actuació regular'
				     ));

	TipusActuacion::create(array('id' => 3, 
				     'nom' => 'Concurs'
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

class TipusCastellsSeeder extends Seeder {

    public function run() {
	DB::table('tipus_castells')->delete();

	TipusCastell::create(array('id' => 1,
				   'nom' => '2de8f',
				   'pinya_necessaria' => 200
				   ));

	TipusCastell::create(array('id' => 2,
				   'nom' => '3de9f',
				   'pinya_necessaria' => 300
				   ));
    }
}

class CastellsSeeder extends Seeder {

    public function run() {
	DB::table('castells')->delete();

	Castell::create(array('id' => 1, 
			      'tipus_castells_fk' => 1,
			      'actuacions_fk' => 1,
			      'ordre_a_placa' => '2',
			      'resultat' => ''
			   ));

	Castell::create(array('id' => 2, 
			      'tipus_castells_fk' => 2,
			      'actuacions_fk' => 2,
			      'ordre_a_placa' => '',
			      'resultat' => 'c'
			   ));
    }
}

class PosicionsSeeder extends Seeder {

    public function run() {
	DB::table('posicions')->delete();

	Posicion::create(array('id' => 1, 
			      'tipus_castells_fk' => 2,
			      'tipus_posicio' => 'Baix',
			      'nom' => 'BaixRengla'
			      ));

	Posicion::create(array('id' => 2, 
			      'tipus_castells_fk' => 2,
			      'tipus_posicio' => 'Baix',
			      'nom' => 'BaixPlena'
			      ));

	Posicion::create(array('id' => 3, 
			      'tipus_castells_fk' => 2,
			      'tipus_posicio' => 'Baix',
			      'nom' => 'BaixBuida'
			      ));

	Posicion::create(array('id' => 4, 
			      'tipus_castells_fk' => 2,
			      'tipus_posicio' => 'Crossa',
			      'nom' => 'CrossaDretaBaixRengla'
			      ));

	Posicion::create(array('id' => 5, 
			      'tipus_castells_fk' => 2,
			      'tipus_posicio' => 'Crossa',
			      'nom' => 'CrossaEsqBaixRengla'
			      ));

	Posicion::create(array('id' => 6, 
			      'tipus_castells_fk' => 2,
			      'tipus_posicio' => 'Crossa',
			      'nom' => 'CrossaDretaBaixPlena'
			      ));

	Posicion::create(array('id' => 7, 
			      'tipus_castells_fk' => 2,
			      'tipus_posicio' => 'Crossa',
			      'nom' => 'CrossaEsqBaixPlena'
			      ));

	Posicion::create(array('id' => 8, 
			      'tipus_castells_fk' => 2,
			      'tipus_posicio' => 'Crossa',
			      'nom' => 'CrossaDretaBaixBuida'
			      ));

	Posicion::create(array('id' => 9, 
			      'tipus_castells_fk' => 2,
			      'tipus_posicio' => 'Crossa',
			      'nom' => 'CrossaEsqBaixBuida'
			      ));
    }
}

class MissatgesSeeder extends Seeder {

    public function run() {
	DB::table('missatges')->delete();

	Missatge::create(array('id' => 1,
			       'titol' => 'Proper assaig de folres',
			       'contingut' => 'Suarem!!',
			       'data_caducitat' => date('Y-m-d', strtotime('next friday'))
			       ));

	Missatge::create(array('id' => 2,
			       'titol' => 'Propera Actuació',
			       'contingut' => 'Actuarem!!',
			       'data_caducitat' => date('Y-m-d', strtotime('next sunday'))
			       ));
    }
}