<?php require '../mainfile.php'; ?>
<html>
  <head>
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Mapa Pacientes</title>
    
    <script src="<?= SCRIPTS . 'jquery-3.3.1.min.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'select2.min.js'; ?>"></script>
    
    <link href="<?= CSS . 'select2.min.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'mapa.css'; ?>" type="text/css" rel="stylesheet">
    
  </head>
  <body>
    
    <div class="container"  id="filtros">
      <form id="form_filtros">
	
	<div class="row">
	  <div class="col-25">
	    <label>DOENÇAS</label>
	  </div>
	  <div class="col-75">
	    <select id="doencas" class="js-example-basic-multiple" name="doencas[]" multiple="multiple" required>
	    </select>
	  </div>
	</div>
	
	<div class="row">
	  <div class="col-25">
	    <label>CIDADES</label>
	  </div>
	  <div class="col-75">
	    <select id="cidades" class="js-example-basic-multiple" name="cidades[]" multiple="multiple" required>
	    </select>
	  </div>
	</div>
	
	<div class="row">
	  <div class="col-25">
	    <label>BAIRROS</label>
	  </div>
	  <div class="col-75">
	    <select id="bairros" class="js-example-basic-multiple" name="bairros[]" multiple="multiple"  required>
	    </select>
	  </div>
	</div>
	
	<div class="row">
	  <div class="col-25">
	    <label>IDADE</label>
	  </div>
	  <div class="col-75">
	    <select id="idade" class="js-example-basic-single" name="idades" required>
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
	  <div class="col-25">
	    <label>SEXO</label>
	  </div>
	  <div class="col-75">
	    <select id="sexo" class="js-example-basic-single" name="sexo" required>
	      <option value="0">AMBOS</option>
	      <option value="0,10">MASCULINO</option>
	      <option value="10,20">FEMININO</option>
	    </select>
	  </div>
	</div>
	
	<div class="row">
	  <button class="submit" id="fbotao">PESQUISAR</button>
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