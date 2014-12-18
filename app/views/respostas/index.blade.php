@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de respostas
		
	</h4>
	<hr>
	{{ Form::open(array('url' => 'respostas', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('pergunta', $pergunta, array('placeholder' => 'Pergunta', 'class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::text('nome', $nome, array('placeholder' => 'Nome', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($respostas->getItems())
		Exibindo de {{ $respostas->getFrom() }} até {{ $respostas->getTo() }} de {{ $respostas->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('respostas?sort=perguntaID' . $str) }}">Id</a></th>
					<th><a href="{{ URL::to('respostas?sort=pergunta' . $str) }}">Título</a></th>
					<th><a href="{{ URL::to('respostas?sort=nome' . $str) }}">Nome</a></th>
					<th><a href="{{ URL::to('respostas?sort=resposta' . $str) }}">Resposta</a></th>
					
				
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($respostas as $resposta)
					<tr>
						<td>{{ e($resposta->perguntaID) }}</td>
						<td>{{ e($resposta->pergunta) }}</td>
						<td>{{ e($resposta->nome) }}</td>
						<td>{{ e($resposta->resposta) }}</td>
						
						<td class="action">
							{{ Form::open(array('url' => 'respostas/' . $resposta->respostaID, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
								{{ Form::button('Apagar', array('type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'Apagar')) }}
							{{ Form::close() }}
						</td>
						
						
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $pagination }}
	@else
		<p class="text-danger"><strong>{{ Util::message('MSG011') }}</strong></p>
	@endif
@stop