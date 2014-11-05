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
			'full_name' => 'Eli José ',
			'email'     => 'ielijose@gmail.com',
			'password'  => '1234',
			'type'      => 'ManagerZone'
		]);
	
		User::create([
			'full_name' => 'Rolando Rodas',
			'email'     => 'rolo27281@gmail.com',
			'password'  => '1234',
			'type'      => 'Agent'
		]);
		
		User::create([
		'full_name' => 'Eliete da Costa',
		'email'     => 'eliete_dacosta@hotmail.com',
		'password'  => '1234',
		'type'      => 'ManagerZone'
		]);
		
		User::create([
			'full_name' => 'Rosana Briceño',
			'email'     => 'jcvaldes_ing@hotmail.com',
			'password'  => '1234',
			'type'      => 'Receptionist'
		]);
	}
}