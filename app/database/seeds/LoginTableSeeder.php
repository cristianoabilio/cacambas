<?php

class LoginTableSeeder extends Seeder {

	public function run()
	{

    $total = 15;

    DB::table('login')->truncate();

    for ($i=1;$i <= $total; $i++){
      DB::table('login')->insert(array(
                                 'login' => 'admin'.$i,
                                 'senha' => Hash::make('admin'),
                                 'status' => 1,
                                 'nome' => 'Admin '.$i,
                                 'email' => 'admin'.$i.'@localhost',
                                 'dthr_cadastro' => date("Y-m-d H:i:s"),
                                 'dthr_ultimoacesso' => date("Y-m-d H:i:s"),
                                 ));
    } 
  }

}
