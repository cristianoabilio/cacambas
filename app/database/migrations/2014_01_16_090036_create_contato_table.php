<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContatoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contato', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('cliente_id');//Cliente FK
			$table->string('tipo', 45);
			$table->string('contato', 45);
			$table->tinyInteger('status')->nullable();
			$table->datetime('dthr_cadastro');
			$table->integer('sessao_id')->nullable();
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
		Schema::drop('contato');
	}

}
