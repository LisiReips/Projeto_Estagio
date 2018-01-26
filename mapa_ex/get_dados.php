<?php

require '../mainfile.php';

function getDoencas(){
  $conexao = new PgConn();
  
  $sql = 'select id,abrev from doencas order by 2';
  $resultado = $conexao->executar($sql);
  
  echo json_encode($resultado);
}

$funcao = filter_input(INPUT_POST,'funcao',FILTER_SANITIZE_NUMBER_INT);
switch($funcao){
  case 1: getDoencas();  break;
}