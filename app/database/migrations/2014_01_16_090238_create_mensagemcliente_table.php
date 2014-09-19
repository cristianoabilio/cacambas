<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMensagemclienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mensagemcliente', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('cliente_id');//Cliente FK
			$table->text('texto');
			$table->datetime('dthr_inserida');
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
		Schema::drop('mensagemcliente');
	}

}
