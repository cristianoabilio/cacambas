<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConvenioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('convenio', function(Blueprint $table) {
			$table->increments('id');//Parent key for fatura, planoconvenio
			$table->integer('empresa_id');//Empresa FK
			$table->integer('limite_id')->nullable();//Limite FK
			$table->integer('plano_id');//Plano FK
			$table->integer('total_nfse')->nullable();
			$table->integer('dia_fatura');
			$table->integer('tipo_pagamento');
			$table->date('dt_inicio');
			$table->date('dt_fim')->nullable();
			$table->datetime('dthr_cadastro');
			$table->integer('sessao_id');
			$table->tinyInteger('status')->nullable();
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
		Schema::drop('convenio');
	}

}
