<?php
  require 'mainfile.php';

  $conexao = new PgConn();

  $sql = "select p.nome, p.prontuario, pac.prontuario as repetido
        from pacientes p
        join pacientes pac on lower(p.nome) = lower(pac.nome) and p.prontuario != pac.prontuario";

  $duplicados = $conexao->executar($sql);

  $sql = "select p.prontuario, p.nome, p.email, p.telefone
        from pacientes p
        where email is null or telefone is null";

  $contatos = $conexao->executar($sql);

  $sql = "select p.prontuario, p.nome, p.rua, p.bairro, p.cep, p.cidade
        from pacientes p
        where rua is null or bairro is null or cep is null or cidade is null";

  $enderecos = $conexao->executar($sql);
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Dados Estatísticos</title>

    <link href="<?= URL . 'libs/bootstrap-3.3.7/dist/css/bootstrap.min.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= URL . 'libs/smartmenus-1.1.0/css/smartmenu.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= URL . 'libs/smartmenus-1.1.0/addons/bootstrap/jquery.smartmenus.bootstrap.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'base.css'; ?>" type="text/css" rel="stylesheet">

    <script src="<?= SCRIPTS . 'jquery-2.2.4.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/bootstrap-3.3.7/dist/js/bootstrap.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/smartmenus-1.1.0/jquery.smartmenus.min.js'; ?>"></script>
    <script src="<?= URL . 'libs/smartmenus-1.1.0/addons/bootstrap/jquery.smartmenus.bootstrap.min.js'; ?>"></script>
  </head>
  <body>
    <?= $barra_menus; ?>
    <br>
    <div class="container-fluid">
      <div class="panel panel-default">
	<table class="table">
	  <caption><b>Pacientes Duplicados</b></caption>
	  <thead >
	  <th><b>Prontuário</b></th>
	  <th><b>Nome</b></th>
	  <th><b>Repetido</b></th>
	  </thead>
	  <tbody>
	    <?php
	      foreach ($duplicados as $duplicado) {
		echo '<tr>' .
		'<td>' . $duplicado['prontuario'] . '</td>' .
		'<td>' . $duplicado['nome'] . '</td>' .
		'<td>' . $duplicado['repetido'] . '</td>' .
		'</tr>';
	      }
	    ?>
	  </tbody>
	</table>
      </div>
      <br />
      <div class="panel panel-default">
	<table class="table">
	  <caption><b>Pacientes sem contato</b></caption>
	  <thead>
	  <th><b>Prontuário</b></th>
	  <th><b>Nome</b></th>
	  <th><b>Telefone</b></th>
	  <th><b>E-mail</b></th>
	  </thead>
	  <tbody>
	    <?php
	      foreach ($contatos as $contato) {
		echo '<tr>' .
		'<td>' . $contato['prontuario'] . '</td>' .
		'<td>' . $contato['nome'] . '</td>' .
		'<td>' . $contato['telefone'] . '</td>' .
		'<td>' . $contato['email'] . '</td>' .
		'</tr>';
	      }
	    ?>
	  </tbody>
	</table>
      </div>
      <br />
      <div class="panel panel-default">
	<table class="table">
	  <caption><b>Pacientes sem endereço</b></caption>
	  <thead>
	  <th><b>Prontuário</b></th> 
	  <th><b>Nome</b></th>
	  <th><b>Endereço</b></th>
	  </thead>
	  <tbody>
	    <?php
	      foreach ($enderecos as $endereco) {
		echo '<tr>' .
		'<td>' . $endereco['prontuario'] . '</td>' .
		'<td>' . $endereco['nome'] . '</td>' .
		'<td>' . $endereco['rua'] . ', ' .
		$endereco['bairro'] . ', ' .
		$endereco['cep'] . ', ' .
		$endereco['cidade'] . '</td>' .
		'</tr>';
	      }
	    ?>
	  </tbody>
	</table>
      </div>
    </div>
  </body>
</html>