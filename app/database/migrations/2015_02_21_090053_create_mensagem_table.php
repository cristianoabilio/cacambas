<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMensagemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mensagem', function(Blueprint $table) {
			$table->increments('id');//Parent key for fatura, planoconvenio
			$table->integer('login_id');//Limite FK
			$table->integer('conversa_id')->nullable();
			$table->integer('conversa_grupo_id')->nullable();
			$table->text('texto');
			$table->integer('status');
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
		Schema::drop('convenio');
	}

}
