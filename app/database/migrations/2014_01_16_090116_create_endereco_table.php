<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnderecoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('endereco', function(Blueprint $table) {
			$table->increments('id');//Parent key for Enderecocliente and Enderecoempresa
			$table->integer('enderecobase_id');//Enderecobase foreing key
			$table->integer('numero');
			$table->string('cep', 9)->nullable();
			$table->decimal('latitude', 10, 8);
			$table->decimal('longitude', 11, 8);
			$table->time('restricao_hr_inicio')->nullable();
			$table->time('restricao_hr_fim')->nullable();
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
		Schema::drop('endereco');
	}

}
