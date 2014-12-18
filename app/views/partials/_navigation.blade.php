<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
	{{ link_to('/', 'AppDoc', array('class' => 'navbar-brand')) }}
</div>
<div class="collapse navbar-collapse">
	<ul class="nav navbar-nav">
    	 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Perguntas<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="http://localhost/appdoc/public/nivel">Nivel</a></li>
            <li><a href="http://localhost/appdoc/public/categoria">Categoria </a></li>
            <li class="divider"></li>
            <li><a href="http://localhost/appdoc/public/pergunta">Pergunta</a></li>
			<li><a href="http://localhost/appdoc/public/questoes">Questoes</a></li>
			<li class="divider"></li>
			<li>{{ link_to('respostas', 'Respostas') }}</li>
			
            </ul>
        </li>
		 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Segurança<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="http://localhost/appdoc/public/perfil">Perfis </a></li>
            <li><a href="http://localhost/appdoc/public/usuario">Usuários </a></li>
            </ul>
        </li>
		<li>{{ link_to('tipo', 'TipoObs') }}</li>
	
		<li>{{ link_to('feedback', 'Listar Feedback') }}</li>
		<li>{{ link_to('feedback/create', 'Fale Conosco') }}</li>
		
		<li><a target="_blank" href="http://localhost/appdoc/public/quiz">Quiz </a></li>
		
		<li><a href="http://localhost/appdoc/public/ranking">Ranking </a></li>
			
		<li><a target="_blank" href="http://localhost/appdoc/public/about">Conheça-nos </a></li>
		
	</ul>
	<ul class="nav navbar-nav navbar-right">
        <li> {{ link_to('logout','Logout ('. Auth::user()->nome .')') }}</li>
    </ul>
</div>

