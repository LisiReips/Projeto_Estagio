<?php
  require 'mainfile.php';
  require 'classes/PHPExcel-1.8/Classes/PHPExcel.php';

  if (isset($_POST['pesquisa'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

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

    $objPHPExcel->getActiveSheet()->getStyle("A1:CX1")->getFill()
      ->applyFromArray(array("type" => PHPExcel_Style_Fill::FILL_SOLID, "startcolor" => array("rgb" => "D8E4BC")));
    
    $n_linhas = 2;
    foreach ($resultados as $resultado) {
      $objPHPExcel->getActiveSheet()->SetCellValue('A' . $n_linhas, $resultado['nome']);
      $objPHPExcel->getActiveSheet()->SetCellValue('B' . $n_linhas, PHPExcel_Shared_Date::PHPToExcel($resultado['data']));
      $objPHPExcel->getActiveSheet()->SetCellValue('C' . $n_linhas, $resultado['telefone']);
      $objPHPExcel->getActiveSheet()->SetCellValue('D' . $n_linhas, $resultado['email']);
      $objPHPExcel->getActiveSheet()->getStyle('B' . $n_linhas)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
      $n_linhas++;
    }

    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setTitle('ANIVERSARIANTES');


    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('aniversariantes.xlsx');

    if (file_exists('aniversariantes.xlsx')) {
      $finfo = finfo_open(FILEINFO_MIME);
      header('Content-Disposition: attachment; filename= aniversariantes.xlsx');
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Length: ' . filesize('aniversariantes.xlsx'));
      header('Content-Transfer-Encoding: binary');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Expires: 0');
      finfo_close($finfo);
      ob_clean();
      flush();
      readfile('aniversariantes.xlsx');
    }
  }
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Aniversariantes</title>

    <script src="<?= SCRIPTS . 'jquery.js'; ?>"></script>

    <link href="<?= CSS . 'select2.min.css'; ?>" type="text/css" rel="stylesheet">
    <script src="<?= SCRIPTS . 'menus.js'; ?>"></script>
    <link href="<?= CSS . 'base.css'; ?>" type="text/css" rel="stylesheet">

  </head>
  <body>
     <?= $barra_menus; ?>
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