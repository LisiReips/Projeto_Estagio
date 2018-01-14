<html>
  <head>
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/mapa.js"></script>
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