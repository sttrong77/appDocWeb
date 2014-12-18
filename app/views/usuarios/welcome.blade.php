@extends('layouts.admin')

@section('content')
    <div class="jumbotron">
        <h2>Seja bem-vindo <strong> {{ Auth::user()->nome; }}  </strong></h2>
        <p>Esse é um aplicativo voltada para o desafio do conhecimento, tendo por motivação
		desmistificar o ensino da programação para o uso cotidiano através de um game de perguntas
		e respostas</p>
    </div>
@stop 