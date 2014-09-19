<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnderecoclienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enderecocliente', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('enderecobase_id');
			$table->integer('endereco_id');//Endereco fk
			$table->integer('cliente_id');//Cliente fk
			$table->string('tipo', 45);
			$table->string('complemento', 255);
			$table->string('observacao', 255)->nullable();
			$table->datetime('dthr_cadastro');
			$table->integer('sessao_id');
			$table->timestamps();

			$table->unique(array('enderecobase_id', 'endereco_id', 'cliente_id'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('enderecocliente');
	}

}
