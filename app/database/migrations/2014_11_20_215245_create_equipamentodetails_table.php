<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipamentodetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipamentodetails', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('empresa_equipamento_id');
			$table->integer('quantidade');
			$table->float('preco_base');
			$table->integer('periodo_minimo');
			$table->tinyinteger('dia_extra')->nullable();
			$table->float('preco_extra')->nullable();
			$table->tinyinteger('taxa_extra')->nullable();
			$table->float('multa')->nullable();
			$table->tinyinteger('status')->nullable();
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
		Schema::drop('equipamentodetails');
	}

}
