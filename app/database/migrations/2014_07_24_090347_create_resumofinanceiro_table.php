<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumoFinanceiroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resumofinanceiro', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('empresa_id'); //PK
			$table->integer('mes_referencia'); //PK
			$table->integer('ano_referencia'); //PK
			$table->decimal('total_locacoes_colocada', 10, 5);
			$table->decimal('total_locacoes_troca', 10, 5);
			$table->decimal('total_locacoes_retirada', 10, 5);
			$table->integer('total_os_colocada');
			$table->integer('total_os_troca');
			$table->integer('total_os_retirada');
			$table->decimal('total_recebimento_aberto', 10, 5);
			$table->decimal('total_recebimento_recebido', 10, 5);
			$table->decimal('total_recebimento_atrasado', 10, 5);
			$table->decimal('total_despesa_imposto', 10, 5);
			$table->decimal('total_despesa_pessoal', 10, 5);
			$table->decimal('total_despesa_fixa', 10, 5);
			$table->decimal('total_despesa_variavel', 10, 5);
			$table->decimal('total_despesa_manutencao', 10, 5);
			$table->decimal('total_fluxo_caixa', 10, 5);
			$table->integer('total_boletos_pagos');
			$table->integer('total_pagamentos_cartao');
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
		Schema::drop('resumofinanceiro');
	}

}
