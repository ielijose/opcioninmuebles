<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->string('lastname', 50);
			$table->string('email', 100)->unique();
			$table->string('phone', 50);				
			$table->string('code', 100);	
			$table->enum('estado', ['prospecto']);

			$table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('categories');

			$table->integer('city_id')->unsigned();
			$table->foreign('city_id')->references('id')->on('cities');

			$table->integer('portal_id')->unsigned();
			$table->foreign('portal_id')->references('id')->on('portals');

			$table->integer('service_id')->unsigned();
			$table->foreign('service_id')->references('id')->on('services');

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
				
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
		Schema::drop('customers');
	}

}