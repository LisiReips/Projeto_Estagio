<?php

//todos os links <a> devem conter a classe alink
$barra_menus = "<div id='cssmenu'>
        <ul>
          <li class='active'><a href='" . $url . "home.php' class='alink'>Home</a></li>
	  <li><a href='" . $url . "pacientes.php' class='alink'>Pacientes</a></li>
          <li>
	    <a href='javascript:void(0);'>Mensagens</a>
	    <ul>
	      <li><a href='" . $url . "cadastro_msg.php' class='alink'>Cadastrar</a></li>
              <li><a href='" . $url . "envio_msg.php' class='alink'>Enviar</a></li>
	    </ul>
	  </li>          
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
