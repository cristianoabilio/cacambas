<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAluguelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluguel', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('contrato_id');//Contrato FK
			$table->integer('empresa_id');
			$table->integer('cliente_id');
			$table->integer('enderecoaluguel_id');
			$table->integer('equipamento_id');

			$table->datetime('dthr_inicio');
			$table->datetime('dthr_fim');
			$table->integer('numero_dias')->nullable();
			$table->decimal('valor_base', 10, 5)->nullable();
			$table->decimal('taxa_extra', 10, 5)->nullable();
			$table->char('ajuste', 1)->nullable();
			$table->decimal('ajuste_valor', 10, 5)->nullable();
			$table->decimal('ajuste_percentual', 10, 5)->nullable();
			$table->decimal('valor_final', 10, 5);
			$table->string('observacao', 255)->nullable();

			$table->boolean('prioridade')->nullable();
			$table->integer('ordem')->nullable();
			$table->tinyInteger('status');
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
		Schema::drop('aluguel');
	}

}
