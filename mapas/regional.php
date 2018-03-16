<?php require '../mainfile.php'; ?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Dados Regionais</title>

    <script src="<?= SCRIPTS . 'jquery-2.2.4.min.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'select2.min.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'menus.js'; ?>"></script>

    <link href="<?= CSS . 'select2.min.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'mapa.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'base.css'; ?>" type="text/css" rel="stylesheet">

  </head>
   <body>
    <?= $barra_menus; ?>
  </body>
</html>