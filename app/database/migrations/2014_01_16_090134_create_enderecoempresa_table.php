<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnderecoempresaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enderecoempresa', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('empresa_id');//
			$table->integer('endereco_id');//Endereco foreing key
			$table->string('tipo', 45);
			$table->string('complemento', 255)->nullable();
			$table->string('observacao', 255)->nullable();
			$table->tinyInteger('status');
			$table->datetime('dthr_cadastro');
			$table->integer('sessao_id');
			$table->timestamps();

			$table->unique(array('empresa_id', 'endereco_id'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('enderecoempresa');
	}

}
