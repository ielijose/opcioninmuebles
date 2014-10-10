<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class EstateTableSeeder extends Seeder {

	public function run()
	{
		Estate::create([
			'id' => 1,
			'name' => 'Bogotá'
		]);
		
		Estate::create([
			'id' => 2,
			'name' => 'Cali'
		]);
		
	}

}