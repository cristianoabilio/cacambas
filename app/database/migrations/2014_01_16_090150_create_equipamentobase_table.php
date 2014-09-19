<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipamentobaseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipamentobase', function(Blueprint $table) {
			$table->increments('id');//Parent for Equipamentobasepreco
			$table->string('nome', 45);
			$table->string('classe', 45);
			$table->string('subclasse', 45);
			$table->string('descricao', 255)->nullable();
			$table->tinyInteger('status');
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
		Schema::drop('equipamentobase');
	}

}
