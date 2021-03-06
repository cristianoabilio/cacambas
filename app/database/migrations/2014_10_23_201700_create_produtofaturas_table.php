<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutofaturasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produtofaturas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('convenio_id');
			$table->tinyinteger('closed');
			$table->date('data_compra');
			$table->date('data_vencimiento');
			$table->date('data_pagamento')->nullable();
			$table->float('valor_subtotal');
			$table->string('valor_ajuste_tipo')->nullable();
			$table->float('valor_ajuste_percentual')->nullable();
			$table->float('valor_total');
			$table->text('observacao');
			$table->integer('forma_pagamento');
			$table->integer('status_pagamento');
			$table->integer('pagarme')->nullable();
			$table->text('NSFe')->nullable();
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
		Schema::drop('produtofaturas');
	}

}
