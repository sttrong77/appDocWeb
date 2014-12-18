@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de questoes
		<a href="{{ URL::to('questoes/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	
	<hr>
	@if($questoes->getItems())
		Exibindo de {{ $questoes->getFrom() }} até {{ $questoes->getTo() }} de {{ $questoes->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('questao?sort=nome_questao' . $str) }}">Questão</a></th>
					<th><a href="{{ URL::to('questao?sort=resposta' . $str) }}">Resposta</a></th>
					
				
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($questoes as $questao)
					<tr>
						<td>{{ e($questao->nome_questao) }}</td>
						<td>{{ e($questao->resposta) }}</td>
						
						
							<td class="action">{{ link_to('questoes/' . $questao->id, 'Detalhar', array('class' => 'btn btn-info btn-sm', 'title' => 'Detalhar')) }}</td>
						<td class="action">{{ link_to('questoes/' . $questao->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'questoes/' . $questao->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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