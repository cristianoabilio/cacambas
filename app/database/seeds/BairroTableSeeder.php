<?php

class BairroTableSeeder extends Seeder {

	public function run()
	{
		DB::table('bairro')->truncate();

		//
		for ($i=1; $i <82 ; $i++) { 


			for ($j=1; $j <3 ; $j++) { 


				DB::table('bairro')->insert(
					array(
						'cidade_id'=>$i,
						'zona'=>'zona '.$j,
						'nome'=>'bairro '.$j
						)
					)
				;


			}


		}
		
	}

}
