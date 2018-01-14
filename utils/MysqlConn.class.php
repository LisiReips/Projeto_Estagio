<?php

class MysqlCon extends mysqli {

  private $conexoes = [
      'db_pacientes' => [
          'HOST' => 'localhost',
          'USER' => 'root',
          'PASS' => '315218',
          'DB' => 'db_pacientes'
      ]
  ];

  public function __construct($nome_conexao = null, $array = null) {
    try {
      if ($array != null) {
        parent::__construct($array['HOST'], $array['USER'], $array['PASS'], $array['DB']);
      } else if (isset($this->conexoes[$nome_conexao])) {
        parent::__construct($this->conexoes[$nome_conexao]['HOST'], $this->conexoes[$nome_conexao]['USER'], $this->conexoes[$nome_conexao]['PASS'], $this->conexoes[$nome_conexao]['DB']);
      } else {
        echo 'Nenhuma conexao foi selecionada!';
      }
    } catch (Exception $ex) {
      echo 'Houve um erro na conexão do banco!' . $ex->getMessage();
    }
  }

  public function executar($sql, $nquery = false) {
    try {
      $result = $this->query($sql);
      if ($nquery) {
        $result = $this->affected_rows;
      } else {
        $result = $result->fetch_all(MYSQLI_ASSOC);
      }
      return $result;
    } catch (Exception $ex) {
      echo 'Houve um erro na query!' . $ex->getMessage();
    }
  }

  public function __destruct() {
    $this->close();
  }

}