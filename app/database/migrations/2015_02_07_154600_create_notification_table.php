<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('type');
			$table->string('actor_type', 100);
			$table->integer('actor_id');
			$table->string('actor_name', 100);
			$table->string('verb', 100);
			$table->string('object_type', 100);
			$table->integer('object_id');
			$table->string('object_name', 100);
			$table->string('target_type', 100);
			$table->integer('target_id');
			$table->string('target_name', 100);
			$table->boolean('private');					
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
		Schema::drop('notification');
	}

}
