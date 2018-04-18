<?php

 $barra_menus = '<div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">  <!-- OFF NAVEGACAO -->
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" >CIEMP</a>
    </div>
    <div id="main" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="' . $url . 'home.php">Home</a></li>
	<li><a href="' . $url . 'pacientes.php">Pacientes</a></li>
        <li><a href="' . $url . 'mensagens.php">Mensagens</a></li>          
	<li>
	  <a href="javascript:void(0);">Mapas<span class="caret"></span></a>
	  <ul class="dropdown-menu">
	    <li><a href="' . $url . 'mapas/index.php?x=1" id="link_filtros">Pacientes</a></li>
            <li><a href="' . $url . 'mapas/regional.php">Regional</a></li>
	  </ul>
	</li>
        <li><a href="' . $url . 'estatistica.php">Dados Estatísticos</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>';