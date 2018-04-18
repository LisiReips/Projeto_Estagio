<?php
set_time_limit(0);
require 'mainfile.php';
$msg = '';

function existe($prontuario) {
  $conn = new PgConn();

  $sql = 'select prontuario from pacientes where prontuario = ' . aspas($prontuario);
  $resultado = $conn->executar($sql);

  if (count($resultado) == 0) {
    return false;
  } else {
    return true;
  }
}

function ajusta_cidade($cidade){
  $especiais = ['Á','À','Ã','Â','á','à','ã','â',
                'É','È','Ê','é','è','ê',
                'Í','Ì','Î','í','ì','î',
                'Ó','Ò','Õ','Ô','ó','ò','õ','ô',
                'Ú','Ù','Û','ú','ù','û'];
  $convertidas = ['A','A','A','A','A','A','A','A',
                'E','E','E','E','E','E',
                'I','I','I','I','I','I',
                'O','O','O','O','O','O','O','O',
                'U','U','U','U','U','U'];
  
  return str_replace($especiais,$convertidas,strtoupper($cidade));
}

function aspas($valor) {
  return ($valor == null || $valor == "") ? "null" : "'" . utf8_encode($valor) . "'";
}

function valor($valor) {
  return ($valor == '' || $valor == null) ? "null" : $valor;
}

function converte_data($data) {
  if(valor($data) != "null"){
    $temp = explode("/", $data);
    return "'$temp[2]-$temp[1]-$temp[0]'";
  }else{
    return "null";
  }

}

function gravar($paciente, $atualizar) {
  $conn = new PgConn();
  $paciente[2] = (strtolower($paciente[2]) == "feminino") ? "F" : "M";
 
  if ($atualizar) {
    $sql = "update pacientes set prontuario = " . aspas($paciente[1]) . ", nome = " . aspas($paciente[0]) . ", idade = " . converte_data($paciente[4]) . ", sexo = " . aspas($paciente[2]) . ", rua = " . aspas($paciente[6]) . ", complemento = " . aspas($paciente[7]) . ", bairro = " . aspas($paciente[8]) . ", cep = " .
            aspas($paciente[11]) . ", telefone = " . aspas($paciente[12]) . ", cidade = " . ajusta_cidade($paciente[9]) . " where prontuario = " . aspas($paciente[1]);
  } else {
    $sql = "insert into pacientes (prontuario, caminho_img, situacao, dt_situacao, nome, idade, sexo, rua, complemento, bairro, cep, latitude, longitude, email, telefone, cidade)
values (" . aspas($paciente[1]) . ",null,null,null," . aspas($paciente[0]) . "," . converte_data($paciente[4]) . "," . aspas($paciente[2]) . "," . aspas($paciente[6]) . "," . aspas($paciente[7]) . "," . aspas($paciente[8]) . "," .
            aspas($paciente[11]) . ",null,null,null," . aspas($paciente[12]) . "," . ajusta_cidade($paciente[9]) . ")";
  }
  
  $result = $conn->executar($sql, true);
  
  if($result == 0 || $result == null){
    echo $sql . "<br>";
  }
}

if (isset($_POST['importar'])) {
  $info = pathinfo($_FILES['arquivo']['name']);
  $ext = $info['extension'];
  $newname = "importacao." . $ext;
  if ($ext != 'csv') {
    $msg = 'O ARQUIVO SELECIONADO NÃO É COMPATÍVEL!';
  } else {
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $newname);
    $prim_linha = true;

    $inseridos = 0;
    $atualizados = 0;

    if (($handle = fopen($newname, "r")) !== FALSE) {//se possível ler o arquivo
      while (($data = fgetcsv($handle, 8000, ";")) !== FALSE) {//enquanto tiver informações a ler
        if ($prim_linha) {
          $prim_linha = false;
        } else {
          if (existe($data[1])) {
            gravar($data, true);
            $atualizados++;
          } else {
            gravar($data, false);
            $inseridos++;
          }
        }
      }
    }
    unlik($newname);
    $msg = 'FORAM INSERIDOS ' . $inseridos . ' NOVOS REGISTROS E FORAM ATUALIZADOS ' . $atualizados . ' REGISTROS!';
  }
} else {
  $msg = 'NENHUM ARQUIVO PARA IMPORTAR!';
}
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Pacientes</title>

    <script src="<?= SCRIPTS . 'jquery-2.2.4.min.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'menus.js'; ?>"></script>
    <link href="<?= CSS . 'base.css'; ?>" type="text/css" rel="stylesheet">
  </head>
  <body>
    <?= $msg ?>
  </body>
</html>
