<?php 
class ClasseTableSeeder extends Seeder {			
			
	public function run()		
	{		
		DB::table('classe')->truncate();

		DB::table('classe')->insert(
			array(
				'id'			=>1
				,'nome'			=>'Despesa'
				,'descricao'	=>'Categoria de despesas'
				,'status'		=>1
				,'dthr_cadastro'=>date('Y-m-d')
				,'sessao_id'	=>null
				)
			)
		;

		DB::table('classe')->insert(
			array(
				'id'			=>2
				,'nome'			=>'Manutencao'
				,'descricao'	=>'Categoria de manutencoes em equipamentos'
				,'status'		=>1
				,'dthr_cadastro'=>date('Y-m-d')
				,'sessao_id'	=>null
				)
			)
		;
	}
}

