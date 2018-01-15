<?php require '../mainfile.php'; ?>
<html>
  <head>
    <link href="<?= CSS . 'mapa.css'; ?>" type="text/css" rel="stylesheet">
    <script src="<?= SCRIPTS . 'jquery.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'mapa.js'; ?>"></script>
  </head>
    <body>
      <h3>Meus pacientes</h3>
      <select text-align-last: right id="type" onchange="filterMarkers(this.value);">
        <option direction: rtl value="selecionar">Selecione a doenca</option>
        <option value="asma">Asma</option>
        <option value="hipertensao">Hipertensao</option>
        <option value="diabetes">Diabetes</option>
      </select>
      <div id="map_canvas"></div>
    <div id="map_wrapper">
      <div id="map_canvas" class="mapping"></div>
    </div>
  </body>
</html>