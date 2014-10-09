<?php

class CityTableSeeder extends Seeder {
	public function run()
	{
		$cities = ['Barranquilla', 'Bucaramanga', 'Bogota', 'Cali', 'Medellin', 'Santa Marta']; 

        foreach ($cities as $key => $city) {
            City::create([
                'name' => $city
            ]);
        }
	}
}