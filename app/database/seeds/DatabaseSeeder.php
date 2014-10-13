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

		//$this->call('BranchTableSeeder');
		
		$this->call('CountryTableSeeder');
		$this->call('EstateTableSeeder');
		$this->call('CityTableSeeder');
		$this->call('CategoryTableSeeder');
		$this->call('PortalTableSeeder');
		$this->call('ServiceTableSeeder');
		$this->call('UserTableSeeder');
	}

}
