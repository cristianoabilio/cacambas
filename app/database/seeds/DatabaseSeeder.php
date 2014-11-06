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

		$this->call('BairroTableSeeder');
		$this->call('CidadeTableSeeder');
		$this->call('ClasseTableSeeder');
		$this->call('ConvenioTableSeeder');
		$this->call('EmpresaTableSeeder');
		$this->call('EnderecoBaseTableSeeder');
		$this->call('EnderecoEmpresaTableSeeder');
		$this->call('EnderecoTableSeeder');
		$this->call('EquipamentobaseTableSeeder');
		$this->call('EquipamentobaseprecoTableSeeder');
		$this->call('EquipamentoTableSeeder');
		$this->call('EstadoTableSeeder');
		$this->call('LimiteTableSeeder');
		$this->call('LoginPerfilTableSeeder');
		$this->call('LoginTableSeeder');
		$this->call('PerfilTableSeeder');
		$this->call('PlanoTableSeeder');
		$this->call('ProdutoTableSeeder');
		$this->call('SubclasseTableSeeder');
	}

}