<?php

class CidadeTableSeeder extends Seeder {

	public function run()
	{

    $total = 15;

    DB::table('cidade')->truncate();

    for ($i=1;$i <= $total; $i++){

      DB::table('cidade')->insert(array(
                                   'estado_id' => $i,
                                   'capital' => false,
                                   'nome' => 'Cidade '.$i
                                   ));
    }
  }

}
