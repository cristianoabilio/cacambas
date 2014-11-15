<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustodetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('custodetails', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('subclasse_id')->nullable();
			$table->string('detalhe');
			$table->string('prestadora')->nullable();
			$table->text('descricao')->nullable();
			$table->text('observacao')->nullable();
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
		Schema::drop('custodetails');
	}

}
