<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliente', function(Blueprint $table) {
			$table->increments('id');//Parent key for Enderecocliente, Mensagemcliente, Contato, Precontrato,
			$table->integer('login_id')->nullable();
			$table->integer('empresa_id');
			$table->string('cpf_cnpj', 45)->nullable();
			$table->boolean('pj');
			$table->string('nome', 140);
			$table->integer('tipo_cliente')->nullable();
			$table->integer('tipo_pagamento');
			$table->integer('forma_pagamento');
			$table->decimal('total_pago', 10, 5)->nullable();
			$table->string('badge', 100)->nullable();
			$table->tinyInteger('status');
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
		Schema::drop('cliente');
	}

}
