<?php

class CategoryTableSeeder extends Seeder {

	public function run()
	{
        $categories = ['Casa', 'Apartamento', 'Oficina', 'Finca', 'Local', 'Bodega', 'Lote', 'Habitacion', 'Consultorio', 'Edificio', 'Caba�a', 'Casa lote']; 

        foreach ($categories as $key => $category) {
            Category::create([
                'category' => $category
            ]);
        }
		
	}

}