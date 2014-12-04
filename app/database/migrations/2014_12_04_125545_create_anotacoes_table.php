<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnotacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anotacoes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('anotacoe');
			$table->tinyinteger('status');
			$table->integer('sessao_id');
			$table->integer('login_id');
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
		Schema::drop('anotacoes');
	}

}
