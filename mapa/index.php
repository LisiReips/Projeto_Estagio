<?php require '../mainfile.php'; ?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Mapa Pacientes</title>

    <script src="<?= SCRIPTS . 'jquery.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'select2.min.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'menus.js'; ?>"></script>

    <link href="<?= CSS . 'select2.min.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'mapa.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'base.css'; ?>" type="text/css" rel="stylesheet">

  </head>
  <body>
    <?= $barra_menus; ?>
    <div class="container"  id="filtros" style="display:none;">
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
              <option value="11,20">11 à 20</option>
              <option value="21,30">21 à 30</option>
              <option value="31,40">31 à 40</option>
              <option value="41,50">41 à 50</option>
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
              <option value="A">AMBOS</option>
              <option value="M">MASCULINO</option>
              <option value="F">FEMININO</option>
            </select>
          </div>
        </div>

        <div class="row">
          <button class="btn submit" id="fbotao">PESQUISAR</button>
        </div>

      </form>
    </div>

    <div id="map_wrapper" >
      <button id="voltar" class="botao">FILTROS</button>
      <button class="botao"><a href='aniver.php'>ANIVERSARIANTES</a></button>
      <div id="map_canvas" class="mapping"></div>
    </div>

    <script src="<?= SCRIPTS . 'mapa.js'; ?>"></script>
  </body>
</html>