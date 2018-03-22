<?php

require 'mainfile.php';

function pesquisar_pacientes() {
  $conexao = new PgConn();

  $nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
  $inicial = filter_input(INPUT_POST,'inicial',FILTER_SANITIZE_STRING);
  $final = filter_input(INPUT_POST,'final',FILTER_SANITIZE_STRING);
  $sexo = filter_input(INPUT_POST,'sexo',FILTER_SANITIZE_STRING);
  
  $sql = "select p.prontuario, p.nome, p.idade as nascimento, p.sexo, p.email, p.telefone
        from pacientes p ";
  
  if($nome == "" || $nome == false){
    $sql .= "where (p.idade between '" . $inicial . "' and '" . $final . "')";
    $sql .= ($sexo == "A")? "":" and p.sexo = '" . $sexo . "'";
  }else{
    $nome = str_replace(" ", "%", strtolower($nome));
    $sql .= "where lower(p.nome) like '%" . $nome . "%'";
  }
  $pacientes = $conexao->executar($sql);
  
  echo json_encode($pacientes);
}

$funcao = filter_input(INPUT_POST,'funcao',FILTER_SANITIZE_NUMBER_INT);
switch ($funcao) {
  case 1: pesquisar_pacientes();
    break;
  default : '';
}
?>