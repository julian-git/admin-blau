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

		$this->call('TipusQuoteSeeder');
		$this->call('QuotesSeeder');
		$this->call('FamiliesSeeder');
		$this->call('CastellersSeeder');
		$this->call('TipusActivitatsSeeder');
		$this->call('ActivitatsSeeder');
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
				 'primer_cop_al_any' => '07-01'));

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
			    'tipus_fk' => 1));

	Quote::create(array('id' => 2, 
			    'banc' => 'La Caixa',
			    'codi_banc' => '1111',
			    'oficina' => '2222',
			    'digit_control' => '33',
			    'compte' => '1234567890',
			    'import' => '12.34',
			    'tipus_fk' => 2));

	Quote::create(array('id' => 3, 
			    'banc' => 'Caixa de Catalunya',
			    'codi_banc' => '5555',
			    'oficina' => '6666',
			    'digit_control' => '77',
			    'compte' => '8901234567',
			    'import' => '56.78',
			    'tipus_fk' => 3));
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
				'familia_id_fk' => 1,
				'naixement' => '1980-10-03',
				'dni' => '12345678K',
				'email' => 'jmg@hotmail.com',
				'sexe' => 'H',
				'quota_id_fk' => 1));

	Casteller::create(array('id' => 2, 
				'cognom1' => 'López', 
				'cognom2' => 'García',
				'nom' => 'Joana',
				'mot' => 'Pepa',
				'familia_id_fk' => 2,
				'naixement' => '1979-11-04',
				'dni' => '87654321J',
				'email' => 'jgl@gmail.com',
				'sexe' => 'D',
				'quota_id_fk' => 1));

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
				'tipus_fk' => 1,
				'data' => '2014-02-20'
				      ));

	Activitat::create(array('id' => 2, 
				'titol' => 'Sopar Festa Major',
				'tipus_fk' => 2,
				'data' => '2014-08-20'
				      ));
    }
}
