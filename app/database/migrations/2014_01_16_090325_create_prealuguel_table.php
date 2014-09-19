<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrealuguelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prealuguel', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('precontrato_id');//Precontrato FK
			$table->integer('equipamentobase_id');
			$table->date('dt_inicio');
			$table->date('dt_fim');
			$table->integer('numero_dias')->nullable();
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
		Schema::drop('prealuguel');
	}

}
