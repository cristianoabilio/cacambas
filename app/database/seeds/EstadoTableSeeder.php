<?php

class EstadoTableSeeder extends Seeder {

	public function run()
	{
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

		DB::table('estado')->truncate();

		foreach ($estados as $e) {
			$e=explode('|',$e);
			DB::table('estado')->insert(
				array(
					'nome'=>$e[0],
					'regiao'=>$e[1]
					)
				)
			;
		}
	}

}
