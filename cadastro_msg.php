<?php
require 'mainfile.php';

function aspas($val) {
  return "'" . $val . "'";
}

function cadastrar() {
  $conexao = new PgConn();

  $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
  $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
  $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);

  $sql = "insert into mensagens (titulo, mensagem, data_envio) values (" . aspas($titulo) . "," . aspas($mensagem) . "," . aspas($data) . ")";
  $mensagens = $conexao->executar($sql, true);
  echo $mensagens;
  exit;
}

function alterar() {
  $conexao = new PgConn();

  $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
  $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
  $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

  $sql = "update mensagens set titulo = " . aspas($titulo) . ", mensagem = " . aspas($mensagem) . ", data_envio = " . aspas($data) .
          " where id = " . $id;
  $mensagens = $conexao->executar($sql, true);
  echo $mensagens;
  exit;
}

function deletar(){
  $conexao = new PgConn();
  
  $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
  $sql = 'delete from mensagens where id = ' . $id;

  $registros = $conexao->executar($sql, true);
  
  echo json_encode($registros);
  exit;
}

function carregar(){
  $conexao = new PgConn();
  
  $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
  $sql = 'select id,titulo,mensagem,data_envio from mensagens ';
  
  if($id != -1){
    $sql .= ' where id = ' . $id;
  }
  $registros = $conexao->executar($sql . ' order by titulo');
  
  echo json_encode($registros);
  exit;
}

$funcao = filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_NUMBER_INT);
switch ($funcao) {
  case 1: cadastrar();
    break;
  case 2: alterar();
    break;
  case 3: deletar();
    break;
  case 4: carregar();
    break;
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
    <script src="<?= SCRIPTS . 'cadastro_msg.js'; ?>"></script>

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
            <label><b>Registros</b></label>
          </div>
          <div class="col-75">
            <select id="existentes" class="js-basic">
              <option selected disabled>Selecione</option>
            </select>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-25">
            <label><b>Título</b></label>
          </div>
          <div class="col-75">
            <input name="titulo" id="titulo" type='text' required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-25">
            <label><b>Mensagem</b></label>
          </div>
          <div class="col-75">
            <textarea name="mensagem" id="mensagem" type='text' style="height: 200px;" required></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-25">
            <label><b>Data</b></label>
          </div>
          <br>
          <div class="col-75">
            <input id="data" value="<?= date('Y-m-d'); ?>" name="data" type='date' required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-50-l">
            <button class="btn" type="button" id="deletar" data-id="0">DELETAR</button>
          </div>
          <div class="col-50-r">
            <button class="btn" style="margin-left: 65%;" name="gravar" type="submit" id="gravar" data-id="0"><b>GRAVAR</b></button>
          </div>
          
        </div>
      </form>
  </body>
</html>

