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
			$table->integer('country_id')->unsigned();
			$table->integer('estate_id')->unsigned();				
			$table->integer('city_id')->unsigned();				
			$table->string('zipcode', 10);
			$table->text('description');
			$table->integer('status')->unsigned(); //estrato
			$table->string('image'); //foto de la propiedad
			
			$table->timestamps();
			
			$table->foreign('country_id')->references('id')->on('countries');
			$table->foreign('city_id')->references('id')->on('cities');
			$table->foreign('estate_id')->references('id')->on('estates');
				
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