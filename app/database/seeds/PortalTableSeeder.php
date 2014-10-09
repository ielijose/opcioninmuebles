<?php

class PortalTableSeeder extends Seeder {

	public function run()
	{
        $portals = ['Finca Raiz', 'Finca Raiz Mobile', 'OLX', 'TROVIT', 'Lamudi', 'Vivareal', 'Mercado libre']; 

        foreach ($portals as $key => $portal) {
            Portal::create([
                'portal' => $portal,
            ]);
        }
		
	}

}