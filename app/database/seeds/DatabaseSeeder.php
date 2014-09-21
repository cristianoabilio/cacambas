<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('EstadoTableSeeder');
		$this->call('CidadeTableSeeder');
		$this->call('BairroTableSeeder');
		$this->call('EnderecoBaseTableSeeder');
		$this->call('EnderecoTableSeeder');


		$this->call('EmpresaTableSeeder');

		$this->call('EnderecoEmpresaTableSeeder');

		$this->call('LoginTableSeeder');

		$this->call('PerfilTableSeeder');

		$this->call('LoginPerfilTableSeeder');

		$this->call('EquipamentobaseTableSeeder');
		$this->call('EquipamentobaseprecoTableSeeder');
		$this->call('EquipamentoTableSeeder');

	}

}