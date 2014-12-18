@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-info-sign"></span> Detalhes do feedback
		<a href="{{ URL::to('feedback') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	<p><strong><h2>Feedback do usuário:</strong> {{ $feedback->usuarios->nome}}</p></h2>
	<div class="jumbotron">
    	<p><strong>Título:</strong> {{ $feedback->titulo }}</p>
		<p><strong>Tipo:</strong> {{ $feedback->tipos->descricao }}</p>
		<p><strong>Descrição:</strong> {{ $feedback->descricao }}</p>
		
		
    </div>
@stop