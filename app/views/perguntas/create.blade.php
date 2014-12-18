@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-plus-sign"></span> Adicionar nova pergunta
		<a href="{{ URL::to('pergunta') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'pergunta', 'class' => 'form-horizontal row', 'role' => 'form','files'=>true)) }}


		<div class="col-xs-4 {{ $errors->first('categoria_id') ? 'has-error' : '' }}">
			{{ Form::label('categoria_id', '* Categoria', array('class' => 'control-label')) }}
        	{{ Form::select('categoria_id', Categoria::options(), Input::old('categoria_id'), array('class' => 'form-control select2', 'required')) }}
        	{{ $errors->first('categoria_id', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-xs-4 {{ $errors->first('nivel_id') ? 'has-error' : '' }}">
			{{ Form::label('nivel_id', '* Nível', array('class' => 'control-label')) }}
        	{{ Form::select('nivel_id', Nivel::options(), Input::old('nivel_id'), array('class' => 'form-control select2','required')) }}
        	{{ $errors->first('nivel_id', '<span class="text-danger">:message</span>') }}
		</div>

		
		<div class="col-xs-6 pull-left {{ $errors->first('nome') ? 'has-error' : '' }}">
			{{ Form::label('nome', '* Nome da Pergunta', array('class' => 'control-label')) }}
        	{{ Form::textarea('nome', Input::old('nome'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('nome', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-xs-4 {{ $errors->first('resposta1') ? 'has-error' : '' }}">
			{{ Form::label('resposta1', '* Alternativa 1', array('class' => 'control-label')) }}
        	{{ Form::text('resposta1', Input::old('resposta1'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('resposta1', '<span class="text-danger">:message</span>') }}
		</div>
		<div class="col-xs-4 {{ $errors->first('resposta2') ? 'has-error' : '' }}">
			{{ Form::label('resposta2', '* Alternativa 2', array('class' => 'control-label')) }}
        	{{ Form::text('resposta2',  Input::old('resposta2'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('resposta2', '<span class="text-danger">:message</span>') }}
		</div>
		<div class="col-xs-4 {{ $errors->first('resposta3') ? 'has-error' : '' }}">
			{{ Form::label('resposta3', '* Alternativa 3', array('class' => 'control-label')) }}
        	{{ Form::text('resposta3', Input::old('resposta3'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('nivel_id', '<span class="text-danger">:message</span>') }}
		</div>
		<div class="col-xs-4 {{ $errors->first('resposta4') ? 'has-error' : '' }}">
			{{ Form::label('resposta4', '* Alternativa 4', array('class' => 'control-label')) }}
        	{{ Form::text('resposta4', Input::old('resposta4'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('nivel_id', '<span class="text-danger">:message</span>') }}
		</div>
		<div class="col-xs-4 {{ $errors->first('respostaCerta') ? 'has-error' : '' }}">
			{{ Form::label('respostaCerta', '* Resposta Certa', array('class' => 'control-label')) }}
        	{{ Form::select('respostaCerta', Pergunta::opcoes(), Input::old('respostaCerta'), array('class' => 'form-control select2', 'required')) }}
        	{{ $errors->first('respostaCerta', '<span class="text-danger">:message</span>') }}
		</div>
		<div class="col-xs-4 {{ $errors->first('dica') ? 'has-error' : '' }}">
			{{ Form::label('dica', '* Dica', array('class' => 'control-label')) }}
        	{{ Form::text('dica', Input::old('dica'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('dica', '<span class="text-danger">:message</span>') }}
		</div>
		<div class="col-xs-3 {{ $errors->first('poster') ? 'has-error' : '' }}">
			{{ Form::label('poster', '*Poster') }}
			{{ Form::file('poster') }}
			{{ $errors->first('poster', '<span class="error">:message</span>') }}
		</div>
		
		<div class="col-btn">
			{{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}
		</div>

	{{ Form::close() }}
@stop