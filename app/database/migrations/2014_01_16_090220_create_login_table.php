<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoginTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('login', function(Blueprint $table) {
			$table->increments('id');//Parent key for Cliente, Loginperfil
			$table->integer('empresa_id');
			$table->string('nome', 255);
			$table->string('email', 100);
			$table->string('login', 45);
			$table->text('senha');
			$table->tinyInteger('status');
			$table->datetime('dthr_cadastro');
			$table->datetime('dthr_ultimoacesso');
			$table->string('remember_token',100)->nullable();
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
		Schema::drop('login');
	}

}
