@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de perguntas
		<a href="{{ URL::to('pergunta/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'pergunta', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('categoria', $categoria, array('placeholder' => 'Categoria', 'class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::text('nivel', $nivel, array('placeholder' => 'Nível', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($perguntas->getItems())
		Exibindo de {{ $perguntas->getFrom() }} até {{ $perguntas->getTo() }} de {{ $perguntas->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('pergunta?sort=categoria' . $str) }}">Título</a></th>
					<th><a href="{{ URL::to('pergunta?sort=nivel' . $str) }}">Tipo</a></th>
					<th><a href="{{ URL::to('pergunta?sort=created_at' . $str) }}">Criado</a></th>
					<th><a href="{{ URL::to('pergunta?sort=updated_at' . $str) }}">Modificado</a></th>
				
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($perguntas as $pergunta)
					<tr>
						<td>{{ e($pergunta->categoria) }}</td>
						<td>{{ e($pergunta->nivel) }}</td>
						<td>{{ Util::toTimestamps($pergunta->created_at) }}</td>
						<td>{{ Util::toTimestamps($pergunta->updated_at) }}</td>
						
							<td class="action">{{ link_to('pergunta/' . $pergunta->id, 'Detalhar', array('class' => 'btn btn-info btn-sm', 'title' => 'Detalhar')) }}</td>
						<td class="action">{{ link_to('pergunta/' . $pergunta->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'pergunta/' . $pergunta->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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