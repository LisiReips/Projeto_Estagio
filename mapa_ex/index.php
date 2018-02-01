<?php require '../mainfile.php'; ?>
<html>
  <head>
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Mapa Pacientes</title>
    
    <script src="<?= SCRIPTS . 'jquery-3.3.1.min.js'; ?>"></script>
    <link href="<?= CSS . 'mapa.css'; ?>" type="text/css" rel="stylesheet">
  </head>
  <body>
    
    <div class="container"  id="filtros">
      <form id="form_filtros">
	
	<div class="row">
	  <div class="col-25">
	    <label for="fname">DOENÇAS</label>
	  </div>
	  <div class="col-75">
	    <select id="country" class="" data-live-search="true" name="country">
	      <option value="australia">ASMA</option>
	      <option value="canada">VARIOLA</option>
	    </select>
	  </div>
	</div>
	
	<div class="row">
	  <div class="col-25">
	    <label for="lname">CIDADES</label>
	  </div>
	  <div class="col-75">
	    <select id="country" class="" name="country">
	      <option value="australia">IBIRUBA</option>
	      <option value="canada">ESPUMOSO</option>
	    </select>
	  </div>
	</div>
	
	<div class="row">
	  <div class="col-25">
	    <label for="country">BAIRROS</label>
	  </div>
	  <div class="col-75">
	    <select id="country" class="" name="country">
	      <option value="australia">NORTE</option>
	      <option value="canada">QUEBRADA</option>
	    </select>
	  </div>
	</div>
	
	<div class="row">
	  <div class="col-25">
	    <label for="subject">IDADE</label>
	  </div>
	  <div class="col-75">
	    <select id="idade" class="" name="idade">
	      <option value="0">TODAS AS IDADES</option>
	      <option value="0,10">ATÈ 10 ANOS</option>
	      <option value="10,20">10 à 20</option>
	      <option value="20,30">20 à 30</option>
	      <option value="30,40">30 à 40</option>
	      <option value="40,50">40 à 50</option>
	      <option value="50,200">MAIOR DE 50</option>
	    </select>
	  </div>
	</div>
	
	<div class="row">
	  <input type="submit" value="Submit">
	</div>
	
      </form>
    </div>

    <div id="map_wrapper" style="display:none;">
      <button id="voltar" class="botao">FILTROS</button>
      <div id="map_canvas" class="mapping"></div>
    </div>

    <script src="<?= SCRIPTS . 'mapa.js'; ?>"></script>
  </body>
</html>