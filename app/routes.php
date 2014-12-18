<?php

Route::get('/', function()
{
	if (Auth::check()) {
		return View::make('usuarios.welcome');
	} else {
		return View::make('usuarios.login');
	}
});

Route::get('login', 'UsuariosController@login');
Route::post('login', 'UsuariosController@validate');

//Criar as 2 rotas get e post para cadastro de usuarios

Route::group(array('before' => 'auth|acl'), function()
{
	Route::get('logout', array('uses' => 'UsuariosController@logout', 'as' => 'usuario.logout'));
	Route::get('welcome', array('uses' => 'UsuariosController@welcome', 'as' => 'usuario.welcome'));
	
	Route::resource('perfil', 'PerfisController', array('except' => array('show')));
	
	Route::resource('nivel', 'NiveisController');
	Route::resource('categoria', 'CategoriasController');
	Route::resource('pergunta', 'PerguntasController');
	Route::resource('questoes', 'QuestoesController');
	Route::resource('respostas', 'RespostasController');
	
	Route::resource('ranking', 'UsuariosController2');
	
	Route::resource('usuario', 'UsuariosController', array('except' => array('show'))); //n listará dados

	Route::resource('tipo', 'TiposController');
	Route::resource('feedback', 'FeedbacksController');
	
	Route::get('/quiz' , function()
	{
		return View::make('quiz.index');
	});
	
	Route::get('/about' , function()
	{
		return View::make('about.index');
	});
	
	
});