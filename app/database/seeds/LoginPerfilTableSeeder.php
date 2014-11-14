<?php

class LoginPerfilTableSeeder extends Seeder {

	public function run()
	{
		DB::table('login_perfil')->truncate();

		$l_p=array(
			//login_id|perfil_id
			'1|1',
			'2|2',
			'3|2'/*,
			'4|2',*/
			)
		;

		foreach ($l_p as $v) {
			$v=explode('|', $v);
			DB::table('login_perfil')->insert(array(
				'login_id'		=>$v[0],
				'perfil_id'		=>$v[1],
				'created_at' 	=> date("Y-m-d H:i:s"),
				'updated_at' 	=> date("Y-m-d H:i:s")
				)
			)
			;
		}



		$total = 15;

		

		for ($i=4;$i <= $total; $i++){
			DB::table('login_perfil')->insert(array(
				'login_id' => $i,
				'perfil_id' => 2,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
				)
			)
			;
		}
	}

}
