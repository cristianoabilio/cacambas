<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Eloquent::unguard();

		$this->call('BairroTableSeeder');
		$this->call('CategorycustosTableSeeder');
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
		$this->call('ProdutoTableSeeder');
		$this->call('PlanoTableSeeder');
		$this->call('SubclasseTableSeeder');
		$this->call('LoginTableSeeder');
		$this->command->info('login table has been seeded!');
		$this->call('PerfilTableSeeder');
		$this->command->info('Perfil table has been seeded!');
		$this->call('LoginPerfilTableSeeder');
		$this->command->info('LoginPerfil table has been seeded!');

	}

}