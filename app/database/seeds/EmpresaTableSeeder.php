<?php

class EmpresaTableSeeder extends Seeder {

	public function run()
	{
		DB::table('empresa')->truncate();

		DB::table('empresa')->insert(
			array(
				'id'			=>1,
				'nome' 			=> 'Caçambas.com ',
				'nome_fantasia' => 'Planet Express Caçambas',
				'cnpj' 			=> '234324234234324-1',
				'insc_estadual' => '234324234234324-1',
				'responsavel'	=> 'Diego Antunes',
				'email'			=> 'cacambas@cacambas.com',
				'telefone' 		=> '12345',
				'celular'		=> '12345',
				'observacao' 	=> 'obs ',
				'status' 		=> 1,
				'dthr_cadastro' => date("Y-m-d H:i:s"),
				'sessao_id' 	=> 0
				)
			)
		;


		for ($i=1;$i <= 15; $i++){
			DB::table('empresa')->insert(
				array(
					'nome' 			=> 'Empresa teste '.$i,
	      			'nome_fantasia' => 'Empresa Fantasia '.$i,
					'cnpj' 			=> '234324234234324-'.$i,
					'insc_estadual' => '234324234234324-'.$i,
					'responsavel'	=> 'xyz '.$i,
					'email'			=> 'a@b.com',
					'telefone' 		=> '12345',
					'celular'		=> '12345',
					'observacao' 	=> 'obs '.$i,
					'status' 		=> 1,
					'dthr_cadastro' => date("Y-m-d H:i:s"),
					'sessao_id' 	=> 0
					)
				)
			;
		}
	}
}
