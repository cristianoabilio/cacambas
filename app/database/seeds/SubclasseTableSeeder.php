<?php				
				
class SubclasseTableSeeder extends Seeder {				
				
	public function run()			
	{			
		DB::table('subclasse')->truncate();

		$seed1=array(
			array('Fixas','Aluguel'),
			array('Fixas','Telefone'),
			array('Fixas','Água'),
			array('Fixas','Internet'),
			array('Variáveis','Compras eventuais'),
			array('Variáveis','reuniões'),
			array('Variáveis','almoços'),
			array('Pessoal','Pagamentos de funcionários'),
			array('Impostos','Custos com impostos')
			)
		;

		$seed2=array(
			array('Mecânica','Gastos com mecânica'),
			array('Pintura','Gastos com pintura de caçambas ou caminhão'),
			array('Troca de Óleo','Custos com a troca de óleo de veículos')
			)
		;

		$seeder=array(
			'1'=>$seed1,
			'2'=>$seed2
			)
		;

		foreach ($seeder as $key => $value) {
			foreach ($value as  $v) {
				DB::table('subclasse')->insert(
					array(
						'classe_id'=>$key,
						'nome'=>$v[0],
						'detalhe'=>$v[1],
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
