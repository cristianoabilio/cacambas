<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaxaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('taxa', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('empresa_id');
			$table->integer('equipamentodetail_id');
			$table->integer('cidade_id');
			$table->text('zona');
			$table->integer('bairro_id');
			$table->decimal('valor', 10, 5);
			$table->tinyInteger('status')->nullable();
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
		Schema::drop('taxa');
	}

}
