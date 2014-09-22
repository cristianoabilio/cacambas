<?php

class ConvenioTableSeeder extends Seeder {							
							
	public function run()						
	{						
		DB::table('convenio')->truncate();					
    							
		DB::table('convenio')->insert(array(					
							
			'empresa_id'			=>	3
			,'limite_id'			=>	null
			,'plano_id'				=>	259
			,'total_nfse'			=>	null
			,'dia_fatura'			=>	5
			,'tipo_pagamento'		=>	1
			,'dt_inicio'			=>	date('Y-m-d H:i:s')
			,'dt_fim'				=>	date('Y-m-d', strtotime('+1 years'))
			,'dthr_cadastro'		=>	date('Y-m-d H:i:s')
			,'sessao_id'			=>	9
			,'status'				=>	1
							
							
			)				
		);					
    							
		DB::table('convenio')->insert(array(					
							
			'empresa_id'			=>	4
			,'limite_id'			=>	null
			,'plano_id'				=>	279
			,'total_nfse'			=>	null
			,'dia_fatura'			=>	5
			,'tipo_pagamento'		=>	3
			,'dt_inicio'			=>	date('Y-m-d H:i:s')
			,'dt_fim'				=>	date('Y-m-d', strtotime('+1 years'))
			,'dthr_cadastro'		=>	date('Y-m-d H:i:s')
			,'sessao_id'			=>	9
			,'status'				=>	1
							
							
			)				
		);					
    							
	}						
							
}							
