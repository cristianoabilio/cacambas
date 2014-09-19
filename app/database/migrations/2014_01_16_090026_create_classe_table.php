<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClasseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classe', function(Blueprint $table) {
			$table->increments('id');//Parent key of Subclasse
			$table->string('nome', 45);
			$table->text('descricao')->nullable();
			$table->tinyInteger('status')->nullable();
			$table->datetime('dthr_cadastro')->nullable();
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
		Schema::drop('classe');
	}

}
