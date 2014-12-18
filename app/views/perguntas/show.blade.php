@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-info-sign"></span> Detalhes das perguntas
		<a href="{{ URL::to('pergunta') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
		<img src ="{{ asset($pergunta->poster) }}" 
				 />
	    <p><strong>Categoria da Pergunta:</strong> {{ $pergunta->categorias->descricao }}</p>
		<p><strong>Nível da Pergunta:</strong> {{ $pergunta->niveis->tipo }}</p>
		<p><strong>Pergunta:</strong> {{ $pergunta->nome }}</p>
		
		
 
@stop