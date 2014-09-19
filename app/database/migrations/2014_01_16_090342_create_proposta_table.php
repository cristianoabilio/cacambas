<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePropostaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proposta', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('precontrato_id');//Precontrato FK
			$table->integer('empresa_id');
			$table->decimal('valor_base', 10, 5);
			$table->char('ajuste', 1)->nullable();
			$table->decimal('valor_ajuste', 10, 5)->nullable();
			$table->decimal('percentual_ajuste', 3,3)->nullable();
			$table->decimal('valor_final', 10, 5);
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
		Schema::drop('proposta');
	}

}
