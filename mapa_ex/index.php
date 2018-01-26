<?php require '../mainfile.php'; ?>
<html>
  <head>
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Mapa Pacientes</title>
    <script src="<?= SCRIPTS . 'jquery-3.3.1.min.js'; ?>"></script>
    <link href="<?= CSS . 'mapa.css'; ?>" type="text/css" rel="stylesheet">
  </head>
  <body>

    <div id="divDoencas" style="float: left;">
      <div id="selShowDoencas" class="selShow">
	<input id="selDoencas" class="inpEnt" type="text" src="" placeholder="SELECIONE AS DOENCAS" required="" disabled="">
        <div style="position:absolute; left:0; right:0; top:0; bottom:0;" class=""></div>
      </div>
      <ul id="selectDoencas" class="listSel"></ul>
    </div>
    <button type="submit" id="btn_pesq">PESQUISAR</button>
    <div id="map_wrapper">
      <div id="map_canvas" class="mapping"></div>
    </div>


    <script src="<?= SCRIPTS . 'mapa.js'; ?>"></script>
  </body>
</html>