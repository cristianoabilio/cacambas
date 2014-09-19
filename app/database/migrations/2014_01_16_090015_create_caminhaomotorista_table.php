<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCaminhaomotoristaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('caminhaomotorista', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('caminhao_id');//Caminhao FK
			$table->integer('funcionario_id');//Funcionario FK
			$table->datetime('dthr_inicio');
			$table->datetime('dthr_fim');
			$table->tinyInteger('status');
			$table->integer('sessao_id')->nullable();
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
		Schema::drop('caminhaomotorista');
	}

}
