<?php

class ProdutoTableSeeder extends Seeder {
	public function run () {
		DB::table('produto')->truncate();

		$tangibles=array(
			'TV monitor|Television monitor set|156000',
			'GPS device|GPS hardware device|30000',
			'T-shirt|Cacambas logo tshirt|500'
			)
		;

		foreach ($tangibles as $t) {
			$t=explode('|', $t);
			DB::table('produto')->insert(array(
				'nome'			=>$t[0],
				'descricao'		=>$t[1],
				'requisitos'	=>'no',
				'valor'			=>$t[2],
				'custo_extra'	=>0,
				'servico'		=>0,
				'status'		=>1,
				'dthr_cadastro'	=>date('Y-m-d'),
				'created_at'	=>date('Y-m-d'),
				'updated_at'	=>date('Y-m-d')
				)
			)
			;
		}
			
	}
}