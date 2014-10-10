<?php

class CountryTableSeeder extends Seeder {

	public function run()
	{		
		Country::create([
			'id' => 1,
			'name' => 'Colombia'
		]);
		
		Country::create([
			'id' => 2,
			'name' => 'Argentina'
		]);
		
	}

}