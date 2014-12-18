@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de feedbacks
	</h4>
	<hr>
	{{ Form::open(array('url' => 'feedback', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('titulo', $titulo, array('placeholder' => 'Título', 'class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::text('tipo', $tipo, array('placeholder' => 'Tipo', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($feedbacks->getItems())
		Exibindo de {{ $feedbacks->getFrom() }} até {{ $feedbacks->getTo() }} de {{ $feedbacks->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('feedback?sort=titulo' . $str) }}">Título</a></th>
					<th><a href="{{ URL::to('feedback?sort=tipo' . $str) }}">Tipo</a></th>
					
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($feedbacks as $feedback)
					<tr>
						<td>{{ e($feedback->titulo) }}</td>
						<td>{{ e($feedback->tipo) }}</td>
						
							<td class="action">{{ link_to('feedback/' . $feedback->id, 'Detalhar', array('class' => 'btn btn-info btn-sm', 'title' => 'Detalhar')) }}</td>
						<td class="action">{{ link_to('feedback/' . $feedback->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'feedback/' . $feedback->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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