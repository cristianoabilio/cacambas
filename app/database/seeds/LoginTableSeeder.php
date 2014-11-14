<?php

class LoginTableSeeder extends Seeder {

	public function run()
	{
		$table=DB::table('login');
		$table->truncate();
		$default=array();
		//superuser
		$table->insert(array(
			'id'				=>1,
			'empresa_id'		=>1,
			'login' 			=> 'superuser',
			'senha' 			=> Hash::make('superuser'),
			'status' 			=> 1,
			'nome' 				=> 'superuser',
			'email' 			=> 'superuser@cacambas.com',
			'dthr_cadastro' 	=> date("Y-m-d H:i:s"),
			'dthr_ultimoacesso' => date("Y-m-d H:i:s")
			)
		)
		;
		//empresa2user
		$table->insert(array(
			'id'				=>2,
			'empresa_id'		=>2,
			'login' 			=> 'empresa2user',
			'senha' 			=> Hash::make('empresa2user'),
			'status' 			=> 1,
			'nome' 				=> 'empresa2user',
			'email' 			=> 'empresa2user@cacambas.com',
			'dthr_cadastro' 	=> date("Y-m-d H:i:s"),
			'dthr_ultimoacesso' => date("Y-m-d H:i:s")
			)
		)
		;
		//empresa3user
		$table->insert(array(
			'id'				=>3,
			'empresa_id'		=>3,
			'login' 			=> 'empresa3user',
			'senha' 			=> Hash::make('empresa3user'),
			'status' 			=> 1,
			'nome' 				=> 'empresa3user',
			'email' 			=> 'empresa3user@cacambas.com',
			'dthr_cadastro' 	=> date("Y-m-d H:i:s"),
			'dthr_ultimoacesso' => date("Y-m-d H:i:s")
			)
		)
		;

		$total = 15;

		

		for ($i=4;$i <= $total; $i++){
			if (Login::whereId($i)->count()==0) {
				$table->insert(array(
					'id'				=>$i,
					'empresa_id'		=>$i,
					'login' 			=> 'admin'.$i,
					'senha' 			=> Hash::make('admin'),
					'status' 			=> 1,
					'nome' 				=> 'Admin '.$i,
					'email' 			=> 'admin'.$i.'@localhost',
					'dthr_cadastro' 	=> date("Y-m-d H:i:s"),
					'dthr_ultimoacesso' => date("Y-m-d H:i:s")
					)
				)
				;
			}
				
		}
	}
}
