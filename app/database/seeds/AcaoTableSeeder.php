<?php

class AcaoTableSeeder extends Seeder {

    public function run()
    {

		Acao::create(array('nome' => 'Listar usuários', 'metodo' => 'usuario.index'));
		Acao::create(array('nome' => 'Formulário de inclusão de usuário', 'metodo' => 'usuario.create'));
		Acao::create(array('nome' => 'Adicionar usuário', 'metodo' => 'usuario.store'));
		Acao::create(array('nome' => 'Formulário de alteração de usuário', 'metodo' => 'usuario.edit'));
		Acao::create(array('nome' => 'Alterar usuário', 'metodo' => 'usuario.update'));
		Acao::create(array('nome' => 'Apagar usuário', 'metodo' => 'usuario.destroy'));

		Acao::create(array('nome' => 'Listar perfis', 'metodo' => 'perfil.index'));
		Acao::create(array('nome' => 'Formulário de inclusão de perfil', 'metodo' => 'perfil.create'));
		Acao::create(array('nome' => 'Adicionar perfil', 'metodo' => 'perfil.store'));
		Acao::create(array('nome' => 'Formulário de alteração de perfil', 'metodo' => 'perfil.edit'));
		Acao::create(array('nome' => 'Alterar perfil', 'metodo' => 'perfil.update'));
		Acao::create(array('nome' => 'Apagar perfil', 'metodo' => 'perfil.destroy'));

	}

}