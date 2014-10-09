<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		User::create([
			'full_name' => 'Abdeel Maussa',
			'email'     => 'jcvaldes.ingenieria@gmail.com',
			'password'  => '123456',
			'type'      => 'GeneralManager'
		]);

		User::create([
			'full_name' => 'Eli José Carrasquero',
			'email'     => 'ielijose@gmail.com',
			'password'  => '1234',
			'type'      => 'GeneralManager'
		]);
	}

}