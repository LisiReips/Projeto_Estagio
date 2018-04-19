<?php require 'mainfile.php'; ?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Pacientes</title>

    <link href="<?= URL . 'libs/bootstrap-3.3.7/dist/css/bootstrap.min.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= URL . 'libs/smartmenus-1.1.0/css/smartmenu.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= URL . 'libs/smartmenus-1.1.0/addons/bootstrap/jquery.smartmenus.bootstrap.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'base.css'; ?>" type="text/css" rel="stylesheet">

    <script src="<?= SCRIPTS . 'jquery-2.2.4.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/bootstrap-3.3.7/dist/js/bootstrap.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/smartmenus-1.1.0/jquery.smartmenus.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/smartmenus-1.1.0/addons/bootstrap/jquery.smartmenus.bootstrap.min.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'pacientes.js'; ?>"></script>

  </head>
  <body>
    <?= $barra_menus; ?>
    <br>
    <div class="container-fluid">
      <div class="panel panel-default">
	<table class="table">
	  <caption><b>Pacientes</b></caption>
	  <thead>
	  <th><b>Prontuário</b></th>
	  <th><b>Nome</b></th>
	  <th><b>Nascimento</b></th>
	  <th><b>Sexo</b></th>
	  <th><b>Email</b></th>
	  <th><b>Telefone</b></th>
	  </thead>
	  <tbody id="tabela">

	  </tbody>
	</table>
	<nav aria-label="...">
	  <ul class="pager">
	    <li><a href="javascript:void(0);" id="anterior">Anterior</a></li>
	    <li><a href="javascript:void(0);" id="proximo">Próximo</a></li>
	  </ul>
	</nav>
      </div>
      <br />
      <div class="row">

        <div class="col-md-12 text-center">
	  <div class="well well-sm">
	    <form id="form_filtros" method="POST" enctype="multipart/form-data" action="importar.php">
	      <fieldset>
		<legend class="text-center fheader">Pesquisar</legend>
	      </fieldset>
	      <div class="form-group row">
		<label for="inicial" class="col-sm-4 col-form-label"><b>Nascimento >= </b></label>
		<div class="col-sm-6">
		  <input class="form-control" id="inicial" value="<?= date('Y-m-01'); ?>" name="inicial" type='date' required>
		</div>
	      </div>
	      <div class="form-group row">
		<label for="final" class="col-sm-4 col-form-label"><b>Nascimento <= </b></label>
		<div class="col-sm-6">
		  <input class="form-control" id="final" value="<?= date('Y-m-t'); ?>" name="final" type='date' required>
		</div>
	      </div>
	      <div class="form-group row">
		<label for="nome" class="col-sm-4 col-form-label"><b>Nome</b></label>
		<div class="col-sm-6">
		  <input class="form-control" id="nome" name="nome" type='text' required>
		</div>
	      </div>
	      <div class="form-group row">
		<label for="sexo" class="col-sm-4 col-form-label"><b>Sexo</b></label>
		<div class="col-sm-6">
		  <select class="form-control" id="sexo" name="sexo">
		    <option value="A">AMBOS</option>
		    <option value="F">FEMININO</option>
		    <option value="M">MASCULINO</option>
		  </select>
		</div>
	      </div>
	      <div class="form-group row">
		<label for="arquivo" class="col-sm-4 col-form-label">Arquivo para importação</label>
		<div class="col-sm-6">
		  <input id="arquivo" type="file"  class="form-control-file" accept=".csv" name="arquivo" required>
		</div>
	      </div>
	      <br>
	      <div class="btn-group" role="group" aria-label="...">
		<button type="button" name="gerar" id="gerar" class="btn btn-default">GERAR</button>
		<button name="importar" type="submit" class="btn btn-default">IMPORTAR</button>
		<button type="button" name="pesquisa" id="pesquisar" class="btn btn-default">PESQUISAR</button>
	      </div>
	    </form>
	  </div>
	</div>
      </div>
    </div>
  </body>
</html>