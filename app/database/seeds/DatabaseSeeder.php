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
	DB::table('quotes')->delete();

	Quote::create(array('id' => 1, 'banc' => 'sense quota'));
    }

}
