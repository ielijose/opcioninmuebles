<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('email', 50)->unique();
			$table->string('street', 100);
			$table->string('city', 100);
			$table->string('zipcode', 10);
			$table->string('country', 50);
			$table->string('phone', 30);
			$table->string('cellphone', 30);
			$table->text('observations');
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
		Schema::drop('profiles');
	}

}
