<?php
require 'mainfile.php';


?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Home</title>
    
    <link href="<?= URL . 'libs/bootstrap-3.3.7/dist/css/bootstrap.min.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= URL . 'libs/smartmenus-1.1.0/css/smartmenu.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= URL . 'libs/smartmenus-1.1.0/addons/bootstrap/jquery.smartmenus.bootstrap.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'base.css'; ?>" type="text/css" rel="stylesheet">
    
    <script src="<?= SCRIPTS . 'jquery-2.2.4.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/bootstrap-3.3.7/dist/js/bootstrap.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/smartmenus-1.1.0/jquery.smartmenus.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/smartmenus-1.1.0/addons/bootstrap/jquery.smartmenus.bootstrap.min.js'; ?>"></script>

  </head>
  <body>
    <?= $barra_menus; ?>
    
  </body>
</html>

