<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('custos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('custogrouper_id');
			$table->integer('custodetail_id');
			$table->date('dt_inicio');
			$table->date('dt_fim')->nullable();
			$table->date('dt_pagamento')->nullable();
			$table->float('valor_total');
			$table->float('valor_pago')->nullable();
			$table->tinyinteger('status_financeiro');
			$table->tinyinteger('status_custo');
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
		Schema::drop('custos');
	}

}
