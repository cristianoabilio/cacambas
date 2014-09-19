<?php

class EquipamentobaseprecoTableSeeder extends Seeder {

	public function run()
	{
    $total = 5;
    DB::table('equipamentobasepreco')->truncate();

    for ($i=1;$i <= $total; $i++){

      DB::table('equipamentobasepreco')->insert(array(
                                           'equipamentobase_id' => $i,
                                           'empresa_id' => $i,
                                           'preco_base' => 250.00,
                                           'periodo_minimo' => 7,
                                           'dia_extra' => true,
                                           'preco_extra' => 0.00,
                                           'taxa_extra'=> false,
                                           'multa'=> null,
                                           'status'=> 1,
                                           'sessao_id' => 0,
                                           'dthr_cadastro' => date("Y-m-d H:i:s")
                                           ));
    }

  }

}
