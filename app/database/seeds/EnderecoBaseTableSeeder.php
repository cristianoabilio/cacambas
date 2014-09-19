<?php

class EnderecoBaseTableSeeder extends Seeder {

	public function run()
	{

    $total = 15;

    DB::table('enderecobase')->truncate();

    for ($i=1;$i <= $total; $i++){

      DB::table('enderecobase')->insert(array(
                                   'bairro_id' => $i,
                                   'cidade_id' => $i,
                                   'estado_id' => $i,
                                   'cep' => rand(80000000,89999999),
                                   'logradouro' => 'Xyz '.$i,
                                   'regiao' => 'x'.$i,
                                   'restricao_hr_inicio' => date("H:i:s"),
                                   'restricao_hr_fim' => date("H:i:s"),
                                   'numero_inicio' => rand(100,999),
                                   'numero_fim' => rand(100,999),
                                   'dthr_cadastro' => date("Y-m-d H:i:s"),
                                   'sessao_id' => 0
                                   ));
    }
  }

}
