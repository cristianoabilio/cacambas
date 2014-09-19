<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plano', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nome', 100);
			$table->text('descricao');
			$table->decimal('valor_total', 10, 5);
			$table->decimal('percentual_desconto', 10, 5)->nullable();
			$table->decimal('valor_desconto', 10, 5)->nullable();
			$table->integer('status');
			$table->integer('validade_meses')->nullable();
			$table->integer('valiade_dias')->nullable();
			$table->boolean('disponivel');
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
		Schema::drop('plano');
	}

}
