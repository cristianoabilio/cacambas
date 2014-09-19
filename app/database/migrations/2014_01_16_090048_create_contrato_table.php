<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContratoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contrato', function(Blueprint $table) {
			$table->increments('id');//Parent key for Recibimento, 
			$table->integer('empresa_id');//Empresa FK
			$table->integer('cliente_id');//Cliente FK
			$table->integer('enderecocobranca_id');
			$table->decimal('valor_total', 10, 5);
			$table->char('ajuste', 1)->nullable();
			$table->decimal('ajuste_valor', 10, 5)->nullable();
			$table->decimal('ajuste_percentual', 10, 5)->nullable();
			$table->decimal('valor_final', 10, 5);
			$table->string('observacao', 255)->nullable();
			$table->integer('tipo_pagamento');
			$table->integer('forma_pagamento');
			$table->tinyInteger('status');
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
		Schema::drop('contrato');
	}

}
