<?php require '../mainfile.php'; ?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Mapa Pacientes</title>

    <link href="<?= URL . 'libs/bootstrap-3.3.7/dist/css/bootstrap.min.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= URL . 'libs/smartmenus-1.1.0/css/smartmenu.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= URL . 'libs/smartmenus-1.1.0/addons/bootstrap/jquery.smartmenus.bootstrap.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'base.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'mapa.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'select2.min.css'; ?>" type="text/css" rel="stylesheet">

    <script src="<?= SCRIPTS . 'jquery-2.2.4.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/bootstrap-3.3.7/dist/js/bootstrap.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/smartmenus-1.1.0/jquery.smartmenus.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/smartmenus-1.1.0/addons/bootstrap/jquery.smartmenus.bootstrap.min.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'select2.min.js'; ?>"></script>

  </head>
  <body>
    <?= $barra_menus; ?>
    <br>
    <div class="container-fluid"  id="filtros" style="display:none;">
      <div class="row">
        <div class="col-md-12 text-center">
	  <div class="well well-sm">
	    <form id="form_filtros" method="POST" enctype="multipart/form-data" action="importar.php">
	      <fieldset>
	        <legend class="text-center fheader">Pesquisar</legend>
	      </fieldset>
	      <div class="form-group row">
		<label for="doencas" class="col-sm-4 col-form-label"><b>DOENÇAS</b></label>
		<div class="col-sm-6">
		  <select id="doencas" class="js-example-basic-multiple form-control" name="doencas[]" multiple="multiple" required></select>
		</div>
	      </div>
	      <div class="form-group row">
		<label for="cidades" class="col-sm-4 col-form-label"><b>CIDADES</b></label>
		<div class="col-sm-6">
		  <select id="cidades" class="js-example-basic-multiple form-control" name="cidades[]" multiple="multiple" required></select>
		</div>
	      </div>
	      <div class="form-group row">
		<label for="bairros" class="col-sm-4 col-form-label"><b>BAIRROS</b></label>
		<div class="col-sm-6">
		  <select id="bairros" class="js-example-basic-multiple form-control" name="bairros[]" multiple="multiple"  required></select>
		</div>
	      </div>
	      <div class="form-group row">
		<label for="idade" class="col-sm-4 col-form-label"><b>IDADE</b></label>
		<div class="col-sm-6">
		  <select id="idade" class="js-example-basic-single form-control" name="idades" required>
		    <option value="0">TODAS AS IDADES</option>
		    <option value="0,10">ATÈ 10 ANOS</option>
		    <option value="11,20">11 à 20</option>
		    <option value="21,30">21 à 30</option>
		    <option value="31,40">31 à 40</option>
		    <option value="41,50">41 à 50</option>
		    <option value="50,200">MAIOR DE 50</option>
		  </select>
		</div>
	      </div>
	      <div class="form-group row">
		<label for="sexo" class="col-sm-4 col-form-label"><b>IDADE</b></label>
		<div class="col-sm-6">
		  <select id="sexo" class="js-example-basic-single form-control" name="sexo" required>
		    <option value="A">AMBOS</option>
		    <option value="M">MASCULINO</option>
		    <option value="F">FEMININO</option>
		  </select>
		</div>
	      </div>
	      <br>
	      <div class="form-group row">
		<button class="btn" id="fbotao"><b>PESQUISAR</b></button>
	      </div>
	    </form>
	  </div>
	</div>
      </div>
    </div>
    <div id="map_wrapper">
      <div id="map_canvas" class="mapping"></div>
    </div>

    <script src="<?= SCRIPTS . 'mapa.js'; ?>"></script>
  </body>
</html>