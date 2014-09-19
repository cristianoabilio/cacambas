<?php

class EmpresaTableSeeder extends Seeder {

	public function run()
	{

    $total = 15;

    DB::table('empresa')->truncate();

    for ($i=1;$i <= $total; $i++){

      DB::table('empresa')->insert(array(
                                   'nome' => 'Empresa teste '.$i,
                                   'nome_fantasia' => 'Empresa Fantasia '.$i,
                                   'cnpj' => '234324234234324-'.$i,
                                   'insc_estadual' => '234324234234324-'.$i,
                                   'responsavel'=> 'xyz '.$i,
                                   'email'=> 'a@b.com',
                                   'telefone' => '12345',
                                   'celular'=> '12345',
                                   'observacao' => 'obs '.$i,
                                   'status' => 1,
                                   'dthr_cadastro' => date("Y-m-d H:i:s"),
                                   'sessao_id' => 0
                                   ));
    }
  }

}
