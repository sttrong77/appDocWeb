@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-plus-sign"></span> Adicionar nova pergunta
		<a href="{{ URL::to('questoes') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'questoes', 'class' => 'form-horizontal row', 'role' => 'form')) }}

		<div class="col-xs-6 pull-left {{ $errors->first('nome_questao') ? 'has-error' : '' }}">
			{{ Form::label('nome_questao', '* Nome da Pergunta', array('class' => 'control-label')) }}
        	{{ Form::textarea('nome_questao', Input::old('nome_questao'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('nome_questao', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-xs-4 {{ $errors->first('resposta1') ? 'has-error' : '' }}">
			{{ Form::label('resposta1', '* Resposta 1', array('class' => 'control-label')) }}
        	{{ Form::text('resposta1', Input::old('resposta1'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('resposta1', '<span class="text-danger">:message</span>') }}
		</div>
		<div class="col-xs-4 {{ $errors->first('resposta2') ? 'has-error' : '' }}">
			{{ Form::label('resposta2', '* Resposta 2', array('class' => 'control-label')) }}
        	{{ Form::text('resposta2',  Input::old('resposta2'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('resposta2', '<span class="text-danger">:message</span>') }}
		</div>
		<div class="col-xs-4 {{ $errors->first('resposta3') ? 'has-error' : '' }}">
			{{ Form::label('resposta3', '* Resposta 3', array('class' => 'control-label')) }}
        	{{ Form::text('resposta3', Input::old('resposta3'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('nivel_id', '<span class="text-danger">:message</span>') }}
		</div>
		<div class="col-xs-4 {{ $errors->first('resposta4') ? 'has-error' : '' }}">
			{{ Form::label('resposta4', '* Resposta 4', array('class' => 'control-label')) }}
        	{{ Form::text('resposta4', Input::old('resposta4'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('nivel_id', '<span class="text-danger">:message</span>') }}
		</div>
		<div class="col-xs-4 {{ $errors->first('resposta') ? 'has-error' : '' }}">
			{{ Form::label('resposta', '* Resposta Certa', array('class' => 'control-label')) }}
        	{{ Form::select('resposta', Questoes::opcoes(), Input::old('resposta'), array('class' => 'form-control select2', 'required')) }}
        	{{ $errors->first('respostaCerta', '<span class="text-danger">:message</span>') }}
		</div>
		<div class="col-btn">
			{{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}
		</div>

	{{ Form::close() }}
@stop