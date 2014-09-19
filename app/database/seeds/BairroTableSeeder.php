<?php

class BairroTableSeeder extends Seeder {

	public function run()
	{

    $total = 15;

    DB::table('bairro')->truncate();

    for ($i=1;$i <= $total; $i++){

      DB::table('bairro')->insert(array(
                                   'cidade_id' => $i,
                                   'estado_id' => $i,
                                   'zona' => 'X '.$i,
                                   'nome' => 'Xyz '.$i
                                   ));
    }
  }

}
