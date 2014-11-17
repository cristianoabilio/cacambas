<?php				
				
class SubclasseTableSeeder extends Seeder {				
				
	public function run()			
	{			
		DB::table('subclasse')->truncate();

		$seed1=array(
			'Fixas',
			'Variáveis',
			'Pessoal',
			'Impostos'
			)
		;

		$seed2=array(
			'Mecânica',
			'Pintura'
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
						'nome'=>$v,
						'detalhe'=>'',
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
