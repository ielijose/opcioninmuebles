<?php

class CityTableSeeder extends Seeder {
	public function run()
	{
		City::create([
			'name' => 'Barranquilla'
		]);

		City::create([
			'name' => 'Bogot�'
		]);
		
		City::create([
			'name' => 'Medell�n'
		]);	
	}
}