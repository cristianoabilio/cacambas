<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecebimentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recebimento', function(Blueprint $table) {
			$table->increments('id');//Parent key for pagamentomaxipago
			$table->integer('contrato_id');//Contrato FK
			$table->integer('empresa_id');
			$table->integer('cliente_id');	
			
			$table->decimal('valor_total', 10, 5);
			$table->decimal('valor_pago', 10, 5)->nullable();
			$table->integer('parcela_qtd')->nullable();
			$table->integer('parcela_id')->nullable();
			$table->integer('parcela_id_recebimento')->nullable();
			$table->decimal('parcela_valor', 10, 5)->nullable();

			$table->date('data_lancamento');
			$table->date('data_vencimento');
			$table->integer('status_pagamento');
			$table->tinyInteger('status');
			$table->text('NFSe')->nullable();
			$table->boolean('pagarme')->nullable();
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
		Schema::drop('recebimento');
	}

}
