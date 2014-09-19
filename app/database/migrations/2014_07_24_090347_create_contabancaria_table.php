<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContaBancariaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contabancaria', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('empresa_id');
			$table->string('nome_banco', 100);
			$table->integer('codigo_banco');
			$table->string('conta', 20);
			$table->string('conta_dig', 5);
			$table->char('conta_tipo', 1);
			$table->string('agencia', 10);
			$table->string('agencia_dig', 5);
			$table->string('cpf_cnpj', 45)->nullable();
			$table->boolean('pj')->nullable();
			$table->string('titular', 140)->nullable();
			$table->datetime('dthr_cadastro')->nullable();
			$table->integer('sessao_id')->nullable();
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
		Schema::drop('contabancaria');
	}

}
