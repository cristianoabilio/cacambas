<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipamento', function(Blueprint $table) {
			$table->increments('id');//Parent key
			$table->integer('empresa_id');
			$table->integer('equipamentobase_id');//Equipamentobasepreco FK
			$table->string('codigo', 45);
			$table->text('rfid')->nullable();
			$table->text('qrcode')->nullable();
			$table->text('gps')->nullable();
			$table->tinyInteger('status');
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
		Schema::drop('equipamento');
	}

}
