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

		$this->call('QuotesSeeder');
		$this->command->info('Quotes table seeded');
	}

}

class QuotesSeeder extends Seeder {

    public function run() {
	DB::table('tipus_quotes')->delete();
	TipusQuote::create(array('id' => 1, 'periodicitat' => 0, 'primer_cop_al_any' => '0000-00-00'));

	DB::table('quotes')->delete();
	Quote::create(array('id' => 1, 'banc' => 'sense quota', 'tipus_fk' => 1));
    }

}
