<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLimiteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('limite', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('plano_id')->nullable();//Plano FK
			$table->integer('motoristas');
			$table->integer('caminhoes');
			$table->integer('rastreamento');
			$table->integer('cacambas');
			$table->integer('NFSe');
			$table->boolean('manutencao');
			$table->boolean('pagamentos');
			$table->boolean('fluxo_caixa');
			$table->boolean('relatorio_avancado');
			$table->boolean('benchmarks');
			$table->integer('sessao_id');
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
		Schema::drop('limite');
	}

}
