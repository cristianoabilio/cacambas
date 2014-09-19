<?php

class LoginPerfilTableSeeder extends Seeder {

	public function run()
	{

    $total = 15;

    DB::table('loginperfil')->truncate();

    for ($i=1;$i <= $total; $i++){
      DB::table('loginperfil')->insert(array(
                                       'login_id' => $i,
                                       'empresa_id' => $i,
                                       'perfil_id' => $i,
                                       'ajuda' => 0,
                                       'status' => 1,
                                       'dthr_cadastro' => date("Y-m-d H:i:s"),
                                       'sessao_id' => 0
                                       ));
    }
  }

}
