<?php

class EquipamentobaseTableSeeder extends Seeder {

	public function run()
  {

    $total = 4;

    $classe=array(
                  'entulho',
                  'solos',
                  'brita',
                  'cal',
                  'gesso',
                  'madeira',
                  'asfalto',
                  'cerâmica',
                  'argamassa'
                  );

    $subclasse = array(3, 4, 5, 6, 7, 28, 30,33);
    $descricao = array('Entulho com 100% de Lixo Comum',
                       'Entulho com 75% de Lixo Comum',
                       'Entulho com 50% de Lixo Comum',
                       'Entulho com 25% de Lixo Comum',
                       'Areia e Terra para Solos'
                       );




    DB::table('equipamentobase')->truncate();

    for ($i=1;$i <= $total; $i++){

      DB::table('equipamentobase')->insert(array(
                                           'classe' => $classe[$i],
                                           'nome' => 'caçamba',
                                           'subclasse' => $subclasse[$i],
                                           'descricao' => null,
                                           'dthr_cadastro' => date("Y-m-d H:i:s"),
                                           'sessao_id' => 0,
                                           'status' => 1
                                           ));
    }
  }

}
