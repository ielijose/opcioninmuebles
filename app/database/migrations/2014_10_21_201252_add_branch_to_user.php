<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBranchToUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->integer('branch_id')->unsigned()->nullable();
			$table->foreign('branch_id')->references('id')->on('branches');
		});

	}

	public function down()
	{
		Schema::table('users', function($table)
		{
			$table->dropColumn('branch_id');
		});
	}

}
