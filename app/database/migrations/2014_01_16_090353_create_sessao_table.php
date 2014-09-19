<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSessaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sessao', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('login_id');
			$table->datetime('dthr_login');
			$table->datetime('dthr_logoff');
			$table->string('ip', 100);
			$table->string('laravel_session_id',255);
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
		Schema::drop('sessao');
	}

}
