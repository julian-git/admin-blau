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

		foreach(['TipusQuoteSeeder',
			 'QuotesSeeder',
			 'FamiliesSeeder',
			 'CastellersSeeder',
			 'TipusActivitatsSeeder',
			 'ActivitatsSeeder',

			 'LlocsSeeder',
			 'TipusActuacionsSeeder',
			 'ActuacionsSeeder',
			 'TipusCastellsSeeder',
			 'CastellsSeeder',
			 'TipusPosicionsSeeder',
			 'PosicionsSeeder',
			 'PinyesSeeder'
			 ] as $seeder)
		{
		    $this->call($seeder);
		}
	}

}

class TipusQuoteSeeder extends Seeder {

    public function run() {
	DB::table('tipus_quotes')->delete();
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
	DB::table('quotes')->delete();
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

class TipusActivitatsSeeder extends Seeder {

    public function run() {
	DB::table('tipus_activitats')->delete();

	TipusActivitat::create(array('id' => 1, 
				      'tipus' => 'Calçotada',
				      'descripcio' => ''
				      ));

	TipusActivitat::create(array('id' => 2, 
				      'tipus' => 'Sopar',
				      'descripcio' => ''
				      ));
    }
}

class ActivitatsSeeder extends Seeder {

    public function run() {
	DB::table('activitats')->delete();

	Activitat::create(array('id' => 1, 
				'titol' => 'Calçotada febrer',
				'tipus_activitats_fk' => 1,
				'data' => '2014-02-20'
				      ));

	Activitat::create(array('id' => 2, 
				'titol' => 'Sopar Festa Major',
				'tipus_activitats_fk' => 2,
				'data' => '2014-08-20'
				      ));
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

class TipusActuacioSeeder extends Seeder {

    public function run() {
	DB::table('tipus_actuacions')->delete();

	TipusActuacio::create(array('id' => 1, 
			   'nom' => 'Actuació regular'
			   ));

	TipusActuacio::create(array('id' => 2, 
			   'nom' => 'Concurs'
			   ));
    }
}

class ActuacioSeeder extends Seeder {

    public function run() {
	DB::table('actuacions')->delete();

	Actuacio::create(array('id' => 1, 
			       'nom' => 'Foguerons',
			       'tipus_actuacions_fk' => '1',
			       'data' => '2014-02-05',
			       'llocs_fk' => '1'
			   ));

	Actuacio::create(array('id' => 2, 
			       'nom' => 'Festa Major de Terrassa',
			       'tipus_actuacions_fk' => '1',
			       'data' => '2014-06-05',
			       'llocs_fk' => '2'
			   ));
    }
}

class CastellSeeder extends Seeder {

    public function run() {
	DB::table('castells')->delete();

	Castell::create(array('id' => 1, 
			      'tipus_castell' => '2de8f',
			      'actuacions_fk' => '1',
			      'ordre' => '2'
			   ));

	Castell::create(array('id' => 2, 
			      'tipus_castell' => '3de9f',
			      'actuacions_fk' => '2',
			      'ordre' => '3'
			   ));
    }
}

class PinyeSeeder extends Seeder {

    public function run() {
	DB::table('pinyes')->delete();

	Castell::create(array('id' => 1, 
			      'castells_fk' => '1',
			      'actuacions_fk' => '1',
			      'ordre' => '2'
			   ));

	Castell::create(array('id' => 2, 
			      'tipus_castell' => '3de9f',
			      'actuacions_fk' => '2',
			      'ordre' => '3'
			   ));
    }
}
