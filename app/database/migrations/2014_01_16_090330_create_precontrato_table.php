<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrecontratoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('precontrato', function(Blueprint $table) {
			$table->increments('id');//Parent key for Proposta
			$table->integer('cliente_id');// Cliente FK
			$table->integer('enderecocliente_id');
			$table->string('observacao', 45)->nullable();
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
		Schema::drop('precontrato');
	}

}
