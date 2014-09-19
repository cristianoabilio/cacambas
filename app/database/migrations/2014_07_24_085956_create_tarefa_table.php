<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTarefaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tarefa', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('contrato_id');
			$table->integer('enderecoaluguel_id');
			$table->integer('aluguel_id')->nullable();
			$table->string('tipo_tarefa', 10);
			$table->integer('ordem')->nullable();
			$table->boolean('prioridade')->nullable();
			$table->date('dt_tarefa');
			$table->string('observacao', 255)->nullable();		
			$table->integer('operador_id')->nullable();
			$table->integer('caminhao_id')->nullable();
			$table->integer('motorista_id');
			$table->integer('equipamentobase_id');
			$table->integer('equipamento_id');
			$table->integer('equipamento_novo_id')->nullable();
			$table->tinyInteger('status');
			$table->integer('sessao_id');
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
		Schema::drop('tarefa');
	}

}
