<?php

require '../mainfile.php';

function get_doencas() {
  $conexao = new PgConn();

  $procura = filter_input(INPUT_POST, 'procura', FILTER_SANITIZE_STRING);
  $procura = strtoupper(str_replace(' ', '%', $procura));

  $sql = "select 0 as id, 'TODAS' as abrev 
      union all 
      select id,abrev from doencas
      where (nome like '%" . $procura . "%' or abrev like '%" . $procura . "%')
      order by 2";

  $resultado = $conexao->executar($sql);

  echo json_encode($resultado);
}

function get_cidades() {
  $conexao = new PgConn();

  $procura = filter_input(INPUT_POST, 'procura', FILTER_SANITIZE_STRING);

  $sql = "select 'TODAS' as cidade 
      union all 
      select distinct cidade 
      from pacientes
      where cidade like '%" . $procura . "%'";
  $resultado = $conexao->executar($sql);

  echo json_encode($resultado);
}

function get_bairros() {
  $conexao = new PgConn();

  $cidades = filter_input(INPUT_POST, 'cidades', FILTER_SANITIZE_STRING);
  $procura = filter_input(INPUT_POST, 'procura', FILTER_SANITIZE_STRING);
  $procura = strtoupper(str_replace(' ', '%', $procura));
  $cidades= str_replace("&#39;", "'", $cidades);

  $sql = "select 'TODOS' as bairro 
      union all
      select distinct bairro 
      from pacientes 
      where (cidade IN (" . $cidades . ") OR '0' IN (" . $cidades . ")) and bairro like '%" . $procura . "%'";

  $resultado = $conexao->executar($sql);

  echo json_encode($resultado);
}

function get_pacientes() {
  $conexao = new PgConn();

  $doencas = filter_input(INPUT_POST, 'doencas', FILTER_SANITIZE_STRING);
  $cidades = filter_input(INPUT_POST, 'cidades', FILTER_SANITIZE_STRING);
  $bairros = filter_input(INPUT_POST, 'bairros', FILTER_SANITIZE_STRING);
  $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_STRING);
  $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);

  $idade = explode(",", $idade);
  $bairros = str_replace("&#39;", "'", $bairros);

  $sql = "SELECT p.caminho_img, p.nome, to_char(p.idade,'dd.mm.yyyy') idade, p.sexo, p.rua,
      COALESCE(p.complemento,'') complemento, p.bairro, p.cep, c.nome cidade, p.latitude,p.longitude,
      array_agg(d.abrev) doencas
      FROM pacientes p
      JOIN cidades c on c.id = p.id_cidades
      JOIN pacientes_doencas pd on pd.id_pacientes = p.id
      JOIN doencas d on d.id = pd.id_doencas
      WHERE (d.id IN (" . $doencas . ") OR 0 IN (" . $doencas . "))
	AND (p.id_cidades IN (" . $cidades . ") OR 0 IN (" . $cidades . "))
	AND (p.bairro IN (" . $bairros . ") OR 'TODOS' IN (" . $bairros . "))
	AND (p.sexo = '" . $sexo . "' OR 'A' = '" . $sexo . "')";

  if (isset($idade[1])) {
    $sql .= " AND(2018 - cast(to_char(idade,'yyyy') as integer) BETWEEN " . $idade[0] . " AND " . $idade[1] . ")";
  }
  $sql .= ' GROUP BY p.caminho_img, p.nome, p.idade, p.sexo, p.rua, p.complemento,
      p.bairro, p.cep, c.nome, p.latitude,p.longitude
      ORDER BY P.NOME';

  $resultado = $conexao->executar($sql);
  $tam = count($resultado);

  for ($i = 0; $i < $tam; $i++) {
    $resultado[$i]['idade'] = converter_idade($resultado[$i]['idade']);
    $resultado[$i]['nome'] = converter_nome($resultado[$i]['nome']);
  }

  echo json_encode($resultado);
}

function converter_nome($nome) {
  $final = '';
  $array = explode(' ', $nome);
  foreach ($array as $arr) {
    $final .= $arr[0] . '. ';
  }

  return $final;
}

function converter_idade($data) {
  $hoje = date('d.m.Y h:i:s a', time());
  $bday = new DateTime($data);
  $today = new DateTime($hoje);
  $diff = $today->diff($bday);

  $temp = ':A anos, :M meses e :D dias';
  $idade = str_replace([':A', ':M', ':D'], [$diff->y, $diff->m, $diff->d], $temp);

  return $idade;
}

$funcao = filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_NUMBER_INT);
switch ($funcao) {
  case 1: get_doencas();
    break;
  case 2: get_cidades();
    break;
  case 3: get_bairros();
    break;
  case 4: get_pacientes();
    break;
  default: "";
}