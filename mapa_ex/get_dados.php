<?php

  require '../mainfile.php';

  function get_doencas() {
    $conexao = new PgConn();

    $procura = filter_input(INPUT_POST, 'procura', FILTER_SANITIZE_STRING);
    $procura = strtoupper($procura);
    
    $sql = "select id,abrev from doencas
      where (nome like '%" . $procura . "%' or abrev like '%" . $procura . "%')
      order by 2";
  
    $resultado = $conexao->executar($sql);

    echo json_encode($resultado);
  }

  function get_cidades() {
    $conexao = new PgConn();

    $procura = filter_input(INPUT_POST, 'procura', FILTER_SANITIZE_STRING);

    $sql = "select id,nome from cidades where nome like '%" . $procura . "%' order by nome";
    $resultado = $conexao->executar($sql);

    echo json_encode($resultado);
  }

  function get_pacientes() {
    $conexao = new PgConn();

    $doencas = filtrar_array('doencas');
    $cidades = filtrar_array('cidades');
    $bairros = filtrar_array('bairros');
    $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_STRING);
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);

     echo json_encode([]);
    /*
      $sql = "select p.caminho_img, p.nome, to_char(p.idade,'dd.mm.yyyy') idade, p.sexo, p.rua,
      p.num, COALESCE(p.complemento,'') complemento, p.bairro, p.cep, c.nome cidade, p.latitude,p.longitude,
      array_agg(d.abrev) doencas
      from pacientes p
      join cidades c on c.id=p.id_cidades
      join pacientes_doencas pd on pd.id_pacientes = p.id
      join doencas d on d.id = pd.id_doencas
      WHERE (d.id IN (" . $doencas . ") OR 0 IN (" . $doencas . "))
      group by p.caminho_img, p.nome, p.idade, p.sexo, p.rua, p.num, p.complemento,
      p.bairro, p.cep, c.nome, p.latitude,p.longitude";

      $resultado = $conexao->executar($sql);
      $tam = count($resultado);

      for ($i = 0; $i < $tam; $i++) {
      $resultado[$i]['idade'] = converter_idade($resultado[$i]['idade']);
      }

      echo json_encode($resultado); */
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

  function filtrar_array($var) {
    if (isset($_POST[$var])) {
      $temp = $_POST[$var];
      if (is_array($temp)) {
	return $temp;
      }
    }
    return false;
  }

  $funcao = filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_NUMBER_INT);
  switch ($funcao) {
    case 1: get_doencas();
      break;
    case 2: get_cidades();
      break;
    case 3: get_pacientes();
      break;
    default: "";
  }