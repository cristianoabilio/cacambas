<?php

class CidadeTableSeeder extends Seeder {

	public function run() {
		DB::table('cidade')->truncate();
		$estados=array( 
			'Acre|Norte',
			'Alagoas|Nordeste',
			'Amapá|Norte',
			'Amazonas|Norte',
			'Bahia|Nordeste',
			'Ceará|Nordeste',
			'Distrito Federal|Centro-Oeste',
			'Espírito Santo|Sudeste',
			'Goiás|Centro-Oeste',
			'Maranhão|Nordeste',
			'Mato Grosso|Centro-Oeste',
			'Mato Grosso do Sul|Centro-Oeste',
			'Minas Gerais|Sudeste',
			'Pará|Norte',
			'Paraíba|Nordeste',
			'Paraná|Sul',
			'Pernambuco|Nordeste',
			'Piauí|Nordeste',
			'Rio de Janeiro|Sudeste',
			'Rio Grande do Norte|Nordeste',
			'Rio Grande do Sul|Sul',
			'Rondônia|Norte',
			'Roraima|Norte',
			'Santa Catarina|Sul',
			'São Paulo|Sudeste',
			'Sergipe|Nordeste',
			'Tocantins|Norte'
			) 
		;
		foreach ($estados as $k => $v) {


			$v=explode('|',$v);


			for ($i=0; $i < 3; $i++) { 

				DB::table('cidade')->insert(

					array(
						'estado_id' =>$k+1,
						'capital' => false,
						'nome' => 'Cidade '.($i+1).' for '.$v[0]
						)
					
					)
				;
			}


		}
		#
	}
}
