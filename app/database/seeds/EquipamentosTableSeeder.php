<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class EquipamentosTableSeeder extends Seeder {

	public function run()
	{
		$equipamentos=array(
			'entulho|3',
			'solos|4',
			'brita|5',
			'cal|6',
			'gesso|7',
			'madeira|28',
			'asfalto|30',
			'cerâmica|33',
			'argamassa|34'
			//nome,classe,subclasse,descricao
			)
		;
		//$faker = Faker::create();

		foreach($equipamentos as $e)
		{
			$e=explode('|', $e);
			DB::table('equipamentos')->insert(array(
				'classe' => $e[0],
				'nome' => 'caçamba',
				'subclasse' => $e[1],
				'descricao' => $e[0].' brand Acme',
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s"),
				'sessao_id' => 0,
				'status' => 1
				)
			)
			;
		}
	}

}