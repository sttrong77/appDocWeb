@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Ranking de Usuários
		
	</h4>
	<hr>
	{{ Form::open(array('url' => 'ranking', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('nome', $nome, array('placeholder' => 'Nome', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($usuarios2->getItems())
		Exibindo de {{ $usuarios2->getFrom() }} até {{ $usuarios2->getTo() }} de {{ $usuarios2->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('ranking?sort=nome' . $str) }}">Nome</a></th>
					<th><a href="{{ URL::to('ranking?sort=username' . $str) }}">Usuário</a></th>
					<th><a href="{{ URL::to('ranking?sort=email' . $str) }}">E-mail</a></th>
					<th><a href="{{ URL::to('ranking?sort=pontos' . $str) }}">Pontos</a></th>
					
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($usuarios2 as $usuario2)
					<tr>
						<td>{{ e($usuario2->nome) }}</td>
						<td>{{ e($usuario2->username) }}</td>
						<td>{{ $usuario2->email }}</td>
						<td>{{ $usuario2->pontos }}</td>
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