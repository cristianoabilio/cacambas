<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresaclienteanotacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresaclienteanotacoes', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('empresa_id');//Empresa FK, parent for loginperfil
			$table->integer('cliente_id');//Cliente FK
			$table->text('anotacao');
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
		Schema::drop('empresaclienteanotacoes');
	}

}
