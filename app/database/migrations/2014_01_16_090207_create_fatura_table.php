<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFaturaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fatura', function(Blueprint $table) {
			$table->increments('id');//Parent for Pagamentomaxipago_empresa
			$table->integer('convenio_id');//Convenio FK
			$table->integer('empresa_id');
			$table->integer('mes_referencia')->nullable();
			$table->integer('semestre_referencia')->nullable();
			$table->integer('ano_referencia')->nullable();
			$table->date('data_vencimento');
			$table->date('data_pagamento')->nullable();
			$table->integer('forma_pagamento');
			$table->integer('status_pagamento');
			$table->decimal('valor_plano', 10, 5);
			$table->decimal('valor_prod_compra', 10, 5);
			$table->decimal('valor_prod_uso', 10, 5);
			$table->decimal('valor_boleto', 10, 5);
			$table->decimal('valor_total', 10, 5);
			$table->char('ajuste_tipo')->nullable();
			$table->decimal('ajuste_valor', 10, 5)->nullable();
			$table->decimal('ajuste_percentual', 10, 5)->nullable();
			$table->boolean('pagarme');
			$table->text('NFSe');
			$table->datetime('dthr_cadastro');
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
		Schema::drop('fatura');
	}

}
