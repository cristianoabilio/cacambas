<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComprasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('compras', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('produto_id');
			$table->integer('convenio_id');
			$table->integer('limite')->nullable();
			$table->decimal('desconto_valor', 10, 5)->nullable();
			$table->decimal('desconto_percentual', 10, 5)->nullable();
			$table->boolean('ativado')->nullable();
			$table->datetime('data_compra')->nullable();
			$table->datetime('data_ativacao')->nullable();
			$table->datetime('data_desativacao')->nullable();
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
		Schema::drop('compras');
	}

}
