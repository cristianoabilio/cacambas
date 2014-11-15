<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustogroupersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('custogroupers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('empresa_id');
			$table->string('fkname')->nullable();
			$table->integer('fkid')->nullable();
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
		Schema::drop('custogroupers');
	}

}
