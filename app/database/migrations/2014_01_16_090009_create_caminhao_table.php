<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCaminhaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('caminhao', function(Blueprint $table) {
			$table->increments('id');
			$table->string('placa', 45)->nullable();
			$table->string('renavan', 45)->nullable();
			$table->string('marca', 45)->nullable();
			$table->string('modelo', 45)->nullable();
			$table->string('apelido', 45)->nullable();
			$table->tinyInteger('status');
			$table->text('gps')->nullable();
			$table->integer('sessao_id')->nullable();
			$table->datetime('dthr_cadastro');
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
		Schema::drop('caminhao');
	}

}
