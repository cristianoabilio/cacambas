<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produto', function(Blueprint $table) {
			$table->increments('id');//Parent key for plano
			$table->string('nome', 100);
			$table->text('descricao');
			$table->text('requisitos');
			$table->text('url_imagem')->nullable();
			$table->text('url_video')->nullable();
			$table->decimal('valor', 10, 5);
			$table->decimal('custo_extra', 10, 5)->nullable();
			$table->boolean('servico');
			$table->integer('limite');
			$table->tinyInteger('status');
			$table->text('observacao');
			$table->integer('perfil_id');
			$table->integer('sessao_id');
			$table->date('dthr_cadastro');

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
		Schema::drop('produto');
	}

}
