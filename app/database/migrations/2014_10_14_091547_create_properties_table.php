<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('properties', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('plattformCode');
			$table->string('address');
			$table->string('estate');
			$table->string('city');
			$table->string('zipcode', 10);
			$table->text('description');
			$table->integer('status')->unsigned(); //estrato
			$table->string('image'); //foto de la propiedad
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('properties');
	}

}
