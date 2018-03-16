<?php
require '../mainfile.php'; 

$conexao = new PgConn();

$sql = "select p.nome, p.prontuario, pac.prontuario as repetido
        from pacientes p
        join pacientes pac on lower(p.nome) = lower(pac.nome) and p.prontuario != pac.prontuario";

$duplicados = $conexao->executar($sql);

$sql = "select p.prontuario, p.nome, p.email, p.telefone
        from pacientes p
        where email is null or telefone is null";

$contatos = $conexao->executar($sql);

$sql = "select p.prontuario, p.nome, p.rua, p.num, p.bairro, p.cep, p.id_cidades as cidade
        from pacientes p
        where rua is null or num is null or bairro is null or cep is null or id_cidades is null";

$enderecos = $conexao->executar($sql);

?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= IMG . 'icone.ico'; ?>" >
    <title>Dados Estatísticos</title>

    <script src="<?= SCRIPTS . 'jquery-2.2.4.min.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'select2.min.js'; ?>"></script>
    <script src="<?= SCRIPTS . 'menus.js'; ?>"></script>

    <link href="<?= CSS . 'select2.min.css'; ?>" type="text/css" rel="stylesheet">
    <link href="<?= CSS . 'base.css'; ?>" type="text/css" rel="stylesheet">

  </head>
   <body>
    <?= $barra_menus; ?>
     <br>
     <table>
       <caption><b>Pacientes Duplicados</b></caption>
       <thead>
       <th><b>Prontuário</b></th>
       <th><b>Nome</b></th>
       <th><b>Repetido</b></th>
       </thead>
       <tbody>
         <?php
          foreach($duplicados as $duplicado){
            echo '<tr>'.
                 '<td>' . $duplicado['prontuario'] . '</td>' . 
                 '<td>' . $duplicado['nome'] . '</td>' .
                 '<td>' . $duplicado['repetido'] . '</td>' .
                 '</tr>';
          }
         ?>
       </tbody>
     </table>
     <br />
     <table>
       <caption><b>Pacientes sem contato</b></caption>
       <thead>
       <th><b>Prontuário</b></th>
       <th><b>Nome</b></th>
       <th><b>Telefone</b></th>
       <th><b>E-mail</b></th>
       </thead>
       <tbody>
         <?php
          foreach($contatos as $contato){
            echo '<tr>'.
                 '<td>' . $contato['prontuario'] . '</td>' . 
                 '<td>' . $contato['nome'] . '</td>' .
                 '<td>' . $contato['telefone'] . '</td>' .
                 '<td>' . $contato['email'] . '</td>' .
                 '</tr>';
          }
         ?>
       </tbody>
     </table>
     <br />
     <table>
       <caption><b>Pacientes sem endereço</b></caption>
       <thead>
       <th><b>Prontuário</b></th> 
       <th><b>Nome</b></th>
       <th><b>Endereço</b></th>
       </thead>
       <tbody>
         <?php
          foreach($enderecos as $endereco){
            echo '<tr>'.
                 '<td>' . $endereco['prontuario'] . '</td>' . 
                 '<td>' . $endereco['nome'] . '</td>' .
                 '<td>' . $endereco['rua'] . ', ' .
                  $endereco['num'] . ', ' .
                  $endereco['bairro'] . ', ' .
                  $endereco['cep'] . ', ' .
                  $endereco['cidade'] . '</td>' .
                 '</tr>';
          }
         ?>
       </tbody>
     </table>
  </body>
</html>