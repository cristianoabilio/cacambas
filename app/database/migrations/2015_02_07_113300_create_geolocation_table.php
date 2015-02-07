<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeolocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geolocation', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('motorista_id'); //PK
			$table->decimal('latitude', 10, 6); //PK
			$table->decimal('longitude', 10, 6);
			$table->datetime('data');
			$table->decimal('velocidade', 10, 6);
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
		Schema::drop('geolocation');
	}

}
