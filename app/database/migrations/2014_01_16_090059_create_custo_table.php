<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('custo', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('empresa_id');
			$table->integer('equipamento_id')->nullable();
			$table->integer('caminhao_id')->nullable();
			$table->integer('funcionario_id')->nullable();
			$table->date('dt_inicio');
			$table->date('dt_fim');
			$table->decimal('valor', 10, 5);
			$table->tinyInteger('status_financeiro');
			$table->string('prestadora', 45)->nullable();
			$table->string('detalhe', 255)->nullable();
			$table->tinyInteger('status_custo');
			$table->integer('classe_id');
			$table->integer('subclasse_id');//Subclasse FK
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
		Schema::drop('custo');
	}

}
