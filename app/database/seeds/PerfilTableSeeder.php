<?php

class PerfilTableSeeder extends Seeder {

	public function run()
	{

    $total = 15;

    DB::table('perfil')->truncate();
    $perfis = array('administrador', 'operacional', 'financeiro', 'motorista', 'cliente');
    $total = count($perfis);
    for ($i=1;$i <= $total; $i++){
      DB::table('perfil')->insert(array(
                                       'perfil_id_pai' => $i,
                                       'nome' => $perfis[$i-1],
                                       'descricao' => $perfis[$i-1],
                                       'status' => 1,
                                       'dthr_cadastro' => date("Y-m-d H:i:s"),
                                       'sessao_id' => 0
                                       ));
    }
  }

}
