<?php
//todos os links <a> devem conter a classe alink
  $barra_menus = 
      "<div id='cssmenu'>
        <ul>
          <li class='active'><a href='" . $url . "' class='alink'>Home</a></li>
	  <li><a href='" . $url . "aniver.php' class='alink'>Pacientes</a></li>
          <li><a href='" . $url . "' class='alink'>Cadastro</a></li>
	  <li>
	    <a href='javascript:void(0);'>Mapas</a>
	    <ul>
	      <li><a href='" . $url . "mapas/index.php?x=1' id='link_filtros' class='alink'>Pacientes</a></li>
              <li><a href='" . $url . "mapas/regional.php' class='alink'>Regional</a></li>
	    </ul>
	  </li>
          <li><a href='" . $url . "estatistica.php' class='alink'>Dados Estatísticos</a></li>
        </ul>
      </div>";
  