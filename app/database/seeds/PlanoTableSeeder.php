<?php

class PlanoTableSeeder extends Seeder {							
							
	public function run()						
	{						
		DB::table('plano')->truncate();					
    							
		DB::table('plano')->insert(array(					
							
			'nome'					=>	'Pequeño'
			,'descricao'			=>	'Pequeño'
			,'valor_total'			=>	259
			,'percentual_desconto'	=>	null
			,'valor_desconto'		=>	null
			,'status'				=>	1
			,'validade_meses'		=>	null
			,'valiade_dias'			=>	null
			,'disponivel'			=>	true
			,'sessao_id'			=>	9
			,'dthr_cadastro'		=>	date('Y-m-d H:i:s')
			)				
							
							
		);					
    							
		DB::table('plano')->insert(array(					
							
			'nome'					=>	'medio'
			,'descricao'			=>	'medio'
			,'valor_total'			=>	279
			,'percentual_desconto'	=>	null
			,'valor_desconto'		=>	null
			,'status'				=>	1
			,'validade_meses'		=>	null
			,'valiade_dias'			=>	null
			,'disponivel'			=>	true
			,'sessao_id'			=>	9
			,'dthr_cadastro'		=>	date('Y-m-d H:i:s')
							
							
			)				
		);					
    							
		DB::table('plano')->insert(array(					
							
			'nome'					=>	'grande'
			,'descricao'			=>	'grande'
			,'valor_total'			=>	599
			,'percentual_desconto'	=>	null
			,'valor_desconto'		=>	null
			,'status'				=>	1
			,'validade_meses'		=>	null
			,'valiade_dias'			=>	null
			,'disponivel'			=>	true
			,'sessao_id'			=>	9
			,'dthr_cadastro'		=>	date('Y-m-d H:i:s')
							
							
			)				
		);					
	}						
							
}							
