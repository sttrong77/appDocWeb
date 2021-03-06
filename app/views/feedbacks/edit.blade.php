@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-edit"></span> Alterar feedback
		<a href="{{ URL::to('feedback') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'feedback/' . $feedback->id, 'method' => 'put', 'class' => 'form-horizontal row', 'role' => 'form')) }}

		<div class="col-xs-4 {{ $errors->first('titulo') ? 'has-error' : '' }}">
			{{ Form::label('titulo', '*Título', array('class' => 'control-label')) }}
        	{{ Form::text('titulo', Input::old('titulo', $feedback->titulo), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('titulo', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-xs-4 {{ $errors->first('tipo_id') ? 'has-error' : '' }}">
			{{ Form::label('tipo_id', '* Tipo', array('class' => 'control-label')) }}
        	{{ Form::select('tipo_id', Tipo::options(), Input::old('tipo_id', $feedback->tipo_id), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('tipo_id', '<span class="text-danger">:message</span>') }}
		</div>
<p>
		<div class="col-xs-12 pull-left {{ $errors->first('descricao') ? 'has-error' : '' }}">
			{{ Form::label('descricao', '* Descrição', array('class' => 'control-label')) }}
        	{{ Form::textarea('descricao', Input::old('descricao',$feedback->descricao), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('descricao', '<span class="text-danger">:message</span>') }}
		</div>
</p>
		<div class="col-btn">
			{{ Form::submit('Alterar', array('class' => 'btn btn-primary')) }}
		</div>


	{{ Form::close() }}
@stop