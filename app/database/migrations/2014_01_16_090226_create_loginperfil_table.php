<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoginperfilTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('loginperfil', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('login_id');//Login FK
			$table->integer('empresa_id');//Empresaclienteanotaciones FK
			$table->integer('perfil_id');//Perfil FK
			$table->integer('ajuda')->nullable();
			$table->tinyInteger('status')->nullable();
			$table->datetime('dthr_cadastro');
			$table->integer('sessao_id');
			$table->timestamps();

			$table->unique(array('login_id', 'empresa_id', 'perfil_id'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('loginperfil');
	}

}
