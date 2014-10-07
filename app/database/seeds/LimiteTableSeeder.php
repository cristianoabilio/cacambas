<?php
class LimiteTableSeeder extends Seeder {							
							
	public function run()						
	{						
		DB::table('limite')->truncate();					
    							
		DB::table('limite')->insert(array(					
							
			'plano_id'				=>	1
			,'motoristas'			=>	4
			,'caminhoes'			=>	4
			,'rastreamento'			=>	0
			,'cacambas'				=>	100
			,'NFSe'					=>	0
			,'manutencao'			=>	false
			,'pagamentos'			=>	false
			,'fluxo_caixa'			=>	false
			,'relatorio_avancado'	=>	false
			,'benchmarks'			=>	false
			,'sessao_id'			=>	9
			,'dthr_cadastro'			=>	date('Y-m-d H:i:s')
			,'created_at'			=> date('Y-m-d H:i:s')
			,'updated_at'			=> date('Y-m-d H:i:s')
		));				
    							
		DB::table('limite')->insert(array(					
							
			'plano_id'				=>	2
			,'motoristas'			=>	5
			,'caminhoes'			=>	5
			,'rastreamento'			=>	5
			,'cacambas'				=>	400
			,'NFSe'					=>	50
			,'manutencao'			=>	true
			,'pagamentos'			=>	true
			,'fluxo_caixa'			=>	true
			,'relatorio_avancado'			=>	false
			,'benchmarks'			=>	false
			,'sessao_id'			=>	9
			,'dthr_cadastro'			=>	date('Y-m-d H:i:s')
			,'created_at'			=> date('Y-m-d H:i:s')
			,'updated_at'			=> date('Y-m-d H:i:s')
		));					
    							
		DB::table('limite')->insert(array(
							
			'plano_id'				=>	3
			,'motoristas'			=>	30
			,'caminhoes'			=>	30
			,'rastreamento'			=>	30
			,'cacambas'				=>	1000
			,'NFSe'					=>	300
			,'manutencao'			=>	true
			,'pagamentos'			=>	true
			,'fluxo_caixa'			=>	true
			,'relatorio_avancado'	=>	true
			,'benchmarks'			=>	true
			,'sessao_id'			=>	9
			,'dthr_cadastro'			=>	date('Y-m-d H:i:s')
			,'created_at'			=> date('Y-m-d H:i:s')
			,'updated_at'			=> date('Y-m-d H:i:s')
		));					
    }						
							
}							
