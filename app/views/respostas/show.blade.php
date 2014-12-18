@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-info-sign"></span> Detalhes das respostas
		<a href="{{ URL::to('respostas') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
		<h3><strong>Usuário.: <strong> {{$resposta->nome}}</h3>
	    <p><strong>Nome da Pergunta.:</strong> {{ $resposta->perguntas->nome }}</p>
		<hr>
		<p><strong>Resposta.:</strong> {{ $resposta->resposta }}</p>
		
		
 
@stop