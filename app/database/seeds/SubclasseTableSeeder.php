<?php				
				
class SubclasseTableSeeder extends Seeder {				
				
	public function run()			
	{			
		DB::table('subclasse')->truncate();

		$seed1=array(
			'Fixas'		=>'Aluguel, Telefone, Água, Internet',
			'Variáveis'	=>'Compras eventuais, reuniões, almoços',
			'Pessoal'	=>'Pagamentos de funcionários',
			'Impostos'	=>'Custos com impostos'
			)
		;

		$seed2=array(
			'Mecânica'		=>'Gastos com mecânica',
			'Pintura'		=>'Gastos com pintura de caçambas ou caminhão',
			'Troca de Óleo'	=>'Custos com a troca de óleo de veículos'
			)
		;

		$seeder=array(
			'1'=>$seed1,
			'2'=>$seed2
			)
		;

		foreach ($seeder as $key => $value) {
			foreach ($seed1 as $k => $v) {
				DB::table('subclasse')->insert(
					array(
						'classe_id'=>$key,
						'nome'=>$k,
						'detalhe'=>$v,
						'status'=>1,
						'dthr_cadastro'=>date('Y-m-d'),
						'sessao_id'=>null,
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
						)
					)
				;
			}
		}

			
		

		
				
	}			
}				
