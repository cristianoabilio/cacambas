<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnderecobaseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enderecobase', function(Blueprint $table) {
			$table->increments('id');//Parent key for Endereco
			$table->integer('bairro_id');//Bairro foreing key
			$table->integer('cidade_id');
			$table->integer('estado_id');
			$table->string('cep_base', 9)->nullable();
			$table->string('logradouro', 255);
			$table->string('regiao', 20);
			$table->time('restricao_hr_inicio_base')->nullable();
			$table->time('restricao_hr_fim_base')->nullable();
			$table->integer('numero_inicio');
			$table->integer('numero_fim');
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
		Schema::drop('enderecobase');
	}

}
