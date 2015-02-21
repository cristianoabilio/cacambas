<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConversaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conversa', function(Blueprint $table) {
			$table->increments('id');//Parent key for fatura, planoconvenio
			$table->integer('conversa_grupo_id')->nullable();//Empresa FK
			$table->integer('login_id');//Limite FK
			$table->integer('recipient_id');//Plano FK
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
