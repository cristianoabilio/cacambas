<?php

class PerfilTableSeeder extends Seeder {

	public function run()
	{
		DB::table('perfil')->truncate();

		$perfil=array(
			'admin_cacambas',
			'company',
			'administrador', 
			'operacional', 
			'financeiro', 
			'motorista', 
			'cliente'
			)
		;
		foreach ($perfil as $v) {
			if (Perfil::whereNome($v)->count()==0) {

				//
				DB::table('perfil')->insert(array(
					'nome' =>$v,
					'status' => 1,
					'dthr_cadastro' => date("Y-m-d H:i:s"),
					'sessao_id' => 0
					)
				)
				;
			}
				
		}
	}

}
