@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de tipos
		<a href="{{ URL::to('tipo/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'tipo', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('descricao', $descricao, array('placeholder' => 'Descrição', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($tipos->getItems())
		Exibindo de {{ $tipos->getFrom() }} até {{ $tipos->getTo() }} de {{ $tipos->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('tipo?sort=descricao' . $str) }}">Descrição</a></th>
					<th><a href="{{ URL::to('tipo?sort=created_at' . $str) }}">Criado</a></th>
					<th><a href="{{ URL::to('tipo?sort=updated_at' . $str) }}">Modificado</a></th>
				
					<th colspan="3"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tipos as $tipo)
					<tr>
						<td>{{ e(Util::truncate($tipo->descricao, 100)) }}</td>
						<td>{{ Util::toTimestamps($tipo->created_at) }}</td>
						<td>{{ Util::toTimestamps($tipo->updated_at) }}</td>
						
						<td class="action">{{ link_to('tipo/' . $tipo->id, 'Detalhar', array('class' => 'btn btn-info btn-sm', 'title' => 'Detalhar')) }}</td>
						<td class="action">{{ link_to('tipo/' . $tipo->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'tipo/' . $tipo->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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