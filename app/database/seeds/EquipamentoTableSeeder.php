<?php

class EquipamentoTableSeeder extends Seeder {

	public function run()
	{

    $status = array(0,1);

    $total = 15;
    DB::table('equipamento')->truncate();

    for ($i=1;$i <= $total; $i++){

      DB::table('equipamento')->insert(array(
                                                'equipamentobase_id' => $i,
                                                'empresa_id' => $i,
                                                'codigo' => $i,
                                                'rfid' => null,
                                                'qrcode' => null,
                                                'gps'=> null,
                                                'status'=> $status[rand (0,1)],
                                                'sessao_id' => 0,
                                                'dthr_cadastro' => date("Y-m-d H:i:s")
                                                ));
    }

  }

}
