<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoginPerfilTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('login_perfil', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('login_id')->unsigned()->index();
			$table->foreign('login_id')->references('id')->on('login')->onDelete('cascade');
			$table->integer('perfil_id')->unsigned()->index();
			$table->foreign('perfil_id')->references('id')->on('perfil')->onDelete('cascade');
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
		Schema::drop('login_perfil');
	}

}
