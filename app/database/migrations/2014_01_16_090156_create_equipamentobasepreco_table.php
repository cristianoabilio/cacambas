<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipamentobaseprecoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipamentobasepreco', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('equipamentobase_id');//Equipamentobase FK, parent for taxa, equipamento
			$table->integer('empresa_id');//Empresa FK
			$table->decimal('preco_base', 10, 5);
			$table->integer('periodo_minimo');
			$table->boolean('dia_extra')->nullable();
			$table->decimal('preco_extra', 10, 5)->nullable();
			$table->boolean('taxa_extra')->nullable();
			$table->decimal('multa', 10, 5)->nullable();
			$table->tinyInteger('status')->nullable();
			$table->integer('sessao_id');
			$table->datetime('dthr_cadastro');
			$table->timestamps();

			$table->unique(array('equipamentobase_id', 'empresa_id'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('equipamentobasepreco');
	}

}
