<?php

class ServiceTableSeeder extends Seeder {

	public function run()
	{
        $services = ['Llamar/Efectivo', 'No intersado', 'Credito Empresa', 'Credito Banco', 'Solo consultas']; 

        foreach ($services as $key => $service) {
            Service::create([
                'service' => $service,
            ]);
        }
		
	}

}