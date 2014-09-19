<?php

class EstadoTableSeeder extends Seeder {

	public function run()
	{

    $total = 15;

    DB::table('estado')->truncate();

    for ($i=1;$i <= $total; $i++){

      DB::table('estado')->insert(array(
                                   'nome' => 'Estado '.$i,
                                   'regiao' => 'Regiao '.$i
                                   ));
    }
  }

}
