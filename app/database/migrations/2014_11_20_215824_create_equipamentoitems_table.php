<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipamentoitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipamentoitems', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('equipamentodetail_id');
			$table->string('codigo');
			$table->text('rfid')->nullable();
			$table->text('qrcode')->nullable();
			$table->text('gps')->nullable();
			$table->tinyinteger('status');
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
		Schema::drop('equipamentoitems');
	}

}
