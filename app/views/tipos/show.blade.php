@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-info-sign"></span> Detalhes do veículo
		<a href="{{ URL::to('tipo') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	<div class="jumbotron">
        <p><strong>Descrição:</strong> {{ $tipo->descricao }}</p>
    </div>
@stop