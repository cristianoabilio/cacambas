<?php

class EnderecoTableSeeder extends Seeder {

	public function run()
	{

    $total = 15;

    DB::table('endereco')->truncate();

    for ($i=1;$i <= $total; $i++){

      DB::table('endereco')->insert(array(
                                   'enderecobase_id' => $i,
                                   'numero' => rand(100,999),
                                   'latitude' => rand(-11,99),
                                   'longitude' => rand(-11,99),
                                   'restricao_hr_inicio' => date("H:i:s"),
                                   'restricao_hr_fim' => date("H:i:s"),
                                   'dthr_cadastro' => date("Y-m-d H:i:s"),
                                   'sessao_id' => 0
                                   ));
    }
  }

}
