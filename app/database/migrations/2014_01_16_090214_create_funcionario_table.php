<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuncionarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funcionario', function(Blueprint $table) {
			$table->increments('id');//parent for caminhamotorista
			$table->integer('empresa_id');//Empresa FK  Parent key for operador
			$table->integer('login_id')->nullable();
			$table->string('nome', 45);
			$table->string('funcao', 45)->nullable();
			$table->string('telefone', 45);
			$table->tinyInteger('status')->nullable();
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
		Schema::drop('funcionario');
	}

}
