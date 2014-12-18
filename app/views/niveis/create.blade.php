@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-plus-sign"></span> Adicionar novo veículo
		<a href="{{ URL::to('nivel') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'nivel', 'class' => 'form-horizontal row', 'role' => 'form')) }}

		<div class="col-xs-5 {{ $errors->first('tipo') ? 'has-error' : '' }}">
			{{ Form::label('tipo', '* Tipo', array('class' => 'control-label')) }}
        	{{ Form::text('tipo', Input::old('tipo'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('tipo', '<span class="text-danger">:message</span>') }}
		</div>

		
		<div class="col-btn">
			{{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}
		</div>

	{{ Form::close() }}
@stop
