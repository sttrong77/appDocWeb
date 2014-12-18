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

		// $this->call('UserTableSeeder');
		//$this->call('AcaoTableSeeder');
		//$this->call('PerfilTableSeeder');
		$this->call('UsuarioTableSeeder');
	}

}
