<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOperadorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('operador', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('funcionario_id');
			$table->integer('equipamento_id');//Equipamento FK
			$table->integer('empresa_id');//Funcionario FK
			$table->integer('equipamentobase_id');
			$table->tinyInteger('status')->nullable();
			$table->datetime('dthr_cadastro');
			$table->integer('sessao_id');
			$table->timestamps();

			$table->unique(array('funcionario_id', 'equipamento_id'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('operador');
	}

}
