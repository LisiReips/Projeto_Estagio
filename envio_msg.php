<?php
require 'mainfile.php';

function enviar() {
  /* $conexao = new PgConn();

    $nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
    $inicial = filter_input(INPUT_POST,'inicial',FILTER_SANITIZE_STRING);
    $final = filter_input(INPUT_POST,'final',FILTER_SANITIZE_STRING);
    $sexo = filter_input(INPUT_POST,'sexo',FILTER_SANITIZE_STRING);
    $n_page = filter_input(INPUT_POST,'n_page',FILTER_SANITIZE_NUMBER_INT);

    $sql = "select p.prontuario, p.nome, p.idade as nascimento, p.sexo, p.email, p.telefone
    from pacientes p ";

    if($nome == "" || $nome == false){
    $sql .= "where (p.idade between '" . $inicial . "' and '" . $final . "')";
    $sql .= ($sexo == "A")? "":" and p.sexo = '" . $sexo . "' ";
    $sql .= " limit 10 offset 10*(" . $n_page . "-1);";
    }else{
    $nome = str_replace(" ", "%", strtolower($nome));
    $sql .= "where lower(p.nome) like '%" . $nome . "%'";
    }

    $pacientes = $conexao->executar($sql);

    echo json_encode($pacientes); */
}
?>

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
  </head>
  <body>
    <?= $barra_menus; ?>
    <br>
    <div class="container" id="filtros">
      <form id="form_filtros" method="POST" class="central_pequeno" action="cadastro_msg.php">
        <br><br>
        <div class="row">
          <div class="col-25">
            <label><b>Título</b></label>
          </div>
          <div class="col-75">
            <input id="nome" name="titulo" type='text' required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-25">
            <label><b>E-mails</b></label>
          </div>
          <div class="col-75">
            <textarea id="nome" name="mensagem" type='text' style="height: 200px;" required></textarea>
          </div>
        </div>
        <br>
        <br>
        <div class="row">
          <div class="col-50-r">
            <button class="btn" style="margin-left: 55%;" name="enviar" type="button" id="gerar"><b>ENVIAR</b></button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>

