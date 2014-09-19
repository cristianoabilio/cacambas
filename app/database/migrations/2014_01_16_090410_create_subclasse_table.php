<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubclasseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subclasse', function(Blueprint $table) {
			$table->increments('id');//Parent key for custo
			$table->integer('classe_id');//Classe FK
			$table->tinyInteger('status');
			$table->datetime('dthr_cadastro');
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
		Schema::drop('subclasse');
	}

}
