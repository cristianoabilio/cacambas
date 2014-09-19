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
			$table->increments('id');
			$table->integer('empresa_id');//Empresa FK
			$table->text('mensagem');
			$table->datetime('dthr_inserida');
			$table->integer('perfil_id');
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
		Schema::drop('mensagem');
	}

}
