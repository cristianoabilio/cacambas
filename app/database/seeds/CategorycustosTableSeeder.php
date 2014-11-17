<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class CategorycustosTableSeeder extends Seeder {

	public function run()
	{
		DB::table('categorycustos')->truncate();

		$fixed=array(
			'Aluguel'
			,'Telefone'
			,'Água'
			,'Internet'
			)
		;
		$variable=array(
			'reuniões',
			'almoços',
			'parts',
			'stationery'
			)
		;
		$salaries=array(
			'salary'
			)
		;
		$taxes=array(
			'taxes'
			)
		;

		$categories=array(
			1=>$fixed,
			2=>$variable,
			3=>$salaries,
			4=>$taxes
			)
		;
		//$faker = Faker::create();

		foreach($categories as $k=>$v)
		{
			foreach ($v as $key => $value) {
				DB::table('categorycustos')->insert(
					array(
					'description'=>$value,
					'subclasse_id'=>$k
				));
			}
				
		}

		$subclasses=array(
			1=>'fixed',
			2=>'variable',
			3=>'salaries',
			4=>'taxes'
			)
		;
		foreach ($subclasses as $key => $value) {
			DB::table('categorycustos')->insert(
				array(
				'description'=>$value,
				'subclasse_id'=>$key)
				)
			;
		}
	}

}