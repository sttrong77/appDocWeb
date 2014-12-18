<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>AppDoc - Desafio do Conhecimento</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--<link href='http://fonts.googleapis.com/css?family=Gloria+Hallelujah' rel='stylesheet' type='text/css'>
		!-->
		{{ HTML::style('assets/css/bootstrap.min.css') }}
		{{ HTML::style('assets/css/footer.css') }}
		{{ HTML::style('assets/img/login.jpg') }}
		{{ HTML::style('assets/css/style.css') }}
		{{ HTML::script('assets/js/jquery-2.0.3.min.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/js/bootstrap.min.js', array('defer' => 'defer')) }}
		
	@if(Auth::check())
		{{ HTML::style('assets/css/datepicker.css') }}
		{{ HTML::style('assets/css/style.css') }}
		{{ HTML::style('assets/css/select2.css') }}
		{{ HTML::style('assets/css/select2-bootstrap.css') }}
		{{ HTML::style('assets/css/admin.css') }}
		{{ HTML::script('assets/js/bootstrap-datepicker.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/js/bootstrap-datepicker.pt-BR.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/js/select2.min.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/js/select2_locale_pt-BR.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/js/jquery.mask.min.js', array('defer' => 'defer')) }}
		{{ HTML::script('assets/js/main.js', array('defer' => 'defer')) }}
	@else
		{{ HTML::style('assets/css/login.css') }}
	@endif
	</head>
	<body>
		@if(Auth::check())
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					@include('partials._navigation')
				</div>
			</div>
		@endif
    	<div class="container">
    		{{ HTML::flash_message() }}
    		
			@yield('content')
    	</div>
		
		<footer>
<div class="foot-fixed-bottom">
<div class="container">
<hr />
© Desenvolvedor • Rodrigo Macedo  - rcbm539@gmail.com</div>
</div>
</footer>
	</body>
</html>