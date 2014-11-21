<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresaEquipamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresa_equipamento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('empresa_id')->unsigned()->index();
			$table->foreign('empresa_id')->references('id')->on('empresa')->onDelete('cascade');
			$table->integer('equipamento_id')->unsigned()->index();
			$table->foreign('equipamento_id')->references('id')->on('equipamentos')->onDelete('cascade');
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
		Schema::drop('empresa_equipamento');
	}

}
