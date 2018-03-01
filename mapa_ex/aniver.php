<?php
require '../mainfile.php';
require '../classes/PHPExcel-1.8/Classes/PHPExcel.php';

if (isset($_POST['pesquisa'])) {
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('America/Sao Paulo');

  $conexao = new PgConn();

  $inicial = $_POST['inicial'];
  $final = $_POST['final'];

  $pesquisa = "select p.nome, COALESCE(p.email,'SEM EMAIL') as email, 
  COALESCE(p.telefone,'SEM TELEFONE') as telefone, to_char(p.idade,'dd/mm/yyyy') as data
  from pacientes p
  where p.idade between '" . $inicial . "' and '" . $final . "'";

  $resultados = $conexao->executar($pesquisa);

  $objPHPExcel = new PHPExcel();
  $objPHPExcel->getProperties()->setCreator("Clínica CIEMP")
          ->setTitle("Aniversariantes")
          ->setSubject("Aniversariantes");

  $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'NOME');
  $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'DATA');
  $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'TELEFONE');
  $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'EMAIL');

  $n_linhas = 2;
  foreach ($resultados as $resultado) {
    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $n_linhas, $resultado['nome']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $n_linhas, $resultado['data']);
    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $n_linhas, $resultado['telefone']);
    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $n_linhas, $resultado['email']);
    $n_linhas++;
  }

  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setTitle('ANIVERSARIANTES');
 

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save('aniversariantes.xlsx');
  
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="aniversariantes.xlsx"');
  header('Cache-Control: max-age=0');
  header('Cache-Control: max-age=1');
  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
  header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
  header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
  header('Pragma: public'); // HTTP/1.0
}
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Aniversariantes</title>

    <script src="<?= SCRIPTS . 'jquery-3.3.1.min.js'; ?>"></script>

    <link href="<?= CSS . 'select2.min.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'base.css'; ?>" type="text/css" rel="stylesheet">

  </head>
  <body>

    <div class="container" id="filtros">
      <form id="form_filtros" method="POST" action="aniver.php">

        <div class="row">
          <div class="col-25">
            <label>INICIAL</label>
          </div>
          <div class="col-75">
            <input id="inicial" value="<?= date('Y-m-d'); ?>" name="inicial" type='date' required>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label>FINAL</label>
          </div>
          <div class="col-75">
            <input id="final" value="<?= date('Y-m-d'); ?>" name="final" type='date' required>
          </div>
        </div>

        <div class="row">
          <button class="btn" name="pesquisa" type="submit" id="pesquisar">PESQUISAR</button>
        </div>

      </form>
    </div>

  </body>
</html>