<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('country_id')->unsigned();
			$table->string('name')->unique();			
			$table->timestamps();
			$table->foreign('country_id')->references('id')->on('countries');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('estates');
	}

}
