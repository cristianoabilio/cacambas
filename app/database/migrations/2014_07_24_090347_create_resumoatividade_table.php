<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumoAtividadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resumoatividade', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('funcionario_id');
			$table->integer('empresa_id');
			$table->datetime('data');
			$table->integer('total_os_colocada');
			$table->integer('total_os_retirada');
			$table->integer('total_os_troca');			
			$table->integer('total_colocada');
			$table->integer('total_retirada');
			$table->integer('total_troca');
			$table->integer('km_percorrida');			
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
		Schema::drop('resumoatividade');
	}

}
