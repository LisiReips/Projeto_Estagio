<?php

  /*
   * Classe de conexão com base de dados Mysql
   */
class MysqlCon extends mysqli {

  /*
   * Quando construido irá se conectar automaticamente
   */
  public function __construct() {
    try {
      parent::__construct(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    } catch (Exception $ex) {
      echo 'Houve um erro na conexão do banco!' . $ex->getMessage();
    }
  }

  /*
   * Metodo de execução de um comando sql
   * @param String $sql O comando sql
   * @param Boolean $nquery Indica se é um Insert/Update/Delete
   * @return Array Resultado da Consulta / Int Numero de linhas afetadas
   */
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

  /*
   * A conexão será fechada automaticamente quando a classe for destruida
   */
  public function __destruct() {
    $this->close();
  }

}