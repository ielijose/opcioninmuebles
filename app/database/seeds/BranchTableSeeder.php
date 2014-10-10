<?php

class BranchTableSeeder extends Seeder {

	public function run()
	{
		Branch::create([
            'id'    => 1,
            'branchId'  => '031',
            'street'  => 'Calle 332',
            'city'  => 'Barranquilla',
            'state'  => 'Bogot�',
            'zipcode'  => 'XXXX',
            'country'  => 'Colombia',
            'phone'  => '0312323232',
        ]);
		
        Branch::create([
            'id'    => 2,
            'branchId'  => '033',
            'street'  => 'Calle 3321',
            'city'  => 'Barranquilla',
            'state'  => 'Bogot�',
            'zipcode'  => 'XXXX',
            'country'  => 'Colombia',
            'phone'  => '012212111',
      ]);
		
	}

}