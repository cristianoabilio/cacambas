<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipamentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipamentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome');
			$table->string('classe');
			$table->string('subclasse');
			$table->string('descricao')->nullable();
			$table->tinyinteger('status');
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
		Schema::drop('equipamentos');
	}

}
