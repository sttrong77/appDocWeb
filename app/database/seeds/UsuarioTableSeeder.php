<?php

class UsuarioTableSeeder extends Seeder {

    public function run()
    {
        DB::table('usuarios')->delete();

		Usuario::create(array(
			'nome' => 'Administrador',
			'username' => 'rodrigo',
			'password' => Hash::make('123'),
			'email' => 'admin@autenticacao.net',
			'ativo' => 1,
			'perfil_id' => 2,
		));
	}

}