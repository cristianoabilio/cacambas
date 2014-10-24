<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutocomprasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produtocompras', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('produtofatura_id');
			$table->integer('amount');
			$table->integer('produto_id');
			$table->integer('session_id');
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
		Schema::drop('produtocompras');
	}

}
