<?php

class EnderecoEmpresaTableSeeder extends Seeder {

	public function run()
	{

    $total = 15;

    DB::table('enderecoempresa')->truncate();

    for ($i=1;$i <= $total; $i++){

      DB::table('enderecoempresa')->insert(array(
                                   'empresa_id' => $i,
                                   'enderecobase_id' => $i,
                                   'endereco_id' => $i,
                                   'tipo' => 'cobranca '.$i,
                                   'complemento' => 'nenhum',
                                   'observacao' => 'observacao '.$i,
                                   'status' => 1,
                                   'dthr_cadastro' => date("Y-m-d H:i:s"),
                                   'sessao_id' => 0
                                   ));
    }
  }

}
