@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-info-sign"></span> Detalhes das perguntas
		<a href="{{ URL::to('questoes') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	<div class="jumbotron">
        
		<p><strong>Pergunta:</strong> {{ $questao->nome_questao }}</p>
		<hr>
		
		
		
    </div>
@stop