<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumoEmpresaClienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resumoempresacliente', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('empresa_id'); //PK
			$table->integer('cliente_id'); //PK
			$table->datetime('data');
			$table->integer('total_locacoes');
			$table->decimal('total_aberto', 10, 5);
			$table->decimal('total_recebido', 10, 5);
			$table->decimal('total_atrasado', 10, 5);
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
		Schema::drop('resumoempresacliente');
	}

}
