<?php require 'mainfile.php'; ?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Pacientes</title>

    <script src="<?= SCRIPTS . 'jquery-2.2.4.min.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'select2.min.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'menus.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'pacientes.js'; ?>"></script>

    <link href="<?= CSS . 'select2.min.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'base.css'; ?>" type="text/css" rel="stylesheet">
    <style>
      @media 
      only screen and (max-width: 760px),
      (min-device-width: 768px) and (max-device-width: 1024px){
        td:nth-of-type(1):before { content: "Prontuario"; }
        td:nth-of-type(2):before { content: "Nome"; }
        td:nth-of-type(3):before { content: "Nascimento"; }
        td:nth-of-type(4):before { content: "Sexo"; }
        td:nth-of-type(5):before { content: "Email"; }
        td:nth-of-type(6):before { content: "Telefone"; }
      }

    </style>

  </head>
  <body>
    <?= $barra_menus; ?>
    <br>
    <table>
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
  <br />
  <div class="container" id="filtros">
    <form id="form_filtros" method="POST" class="central_pequeno" action="dados_pacientes.php">

      <div class="row">
        <div class="col-25">
          <label><b>Nascimento >= </b></label>
        </div>
        <div class="col-75">
          <input id="inicial" value="<?= date('Y-m-d'); ?>" name="inicial" type='date' required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label><b>Nascimento <= </b></label>
        </div>
        <div class="col-75">
          <input id="final" value="<?= date('Y-m-d'); ?>" name="final" type='date' required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label><b>Nome</b></label>
        </div>
        <div class="col-75">
          <input id="nome" name="nome" type='text' required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label><b>Sexo</b></label>
        </div>
        <div class="col-75">
          <select id="sexo" name="sexo">
            <option value="A">AMBOS</option>
            <option value="F">FEMININO</option>
            <option value="M">MASCULINO</option>
          </select>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-50-l">
          <button class="btn" name="gerar" type="button" id="gerar"><b>GERAR</b></button>
        </div>
        <div class="col-50-r" >
          <button class="btn" style="margin-left: 55%;" name="pesquisa" type="button" id="pesquisar"><b>PESQUISAR</b></button>
        </div>
      </div>

    </form>
  </div>
</body>
</html>