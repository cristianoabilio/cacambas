<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresa', function(Blueprint $table) {
			$table->increments('id');//Parent key for: //Enderecoempresa, convenio, empresaclienteanoaciones
			$table->string('nome', 255);
			$table->string('nome_fantasia', 255)->nullable();
			$table->string('cnpj', 45)->nullable();
			$table->string('insc_estadual', 45)->nullable();
			$table->string('responsavel', 140)->nullable();
			$table->string('email', 140);
			$table->string('telefone', 20)->nullable();
			$table->string('celular', 20)->nullable();
			$table->text('observacao')->nullable();
			$table->string('afiliado', 255)->nullable();
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
		Schema::drop('empresa');
	}

}
