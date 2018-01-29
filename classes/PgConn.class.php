<?php

  class PgConn {

    private $conn;

    /*
     * Quando construido irá se conectar automaticamente
     */

    public function __construct() {
      try {
	$this->conn = new PDO('pgsql:dbname=' . DB_NAME . ';port=' . DB_PORT . ';host=' . DB_HOST, DB_USER, DB_PASS);
      } catch (Exception $ex) {
	echo 'Houve um erro ao conectar com o banco!' . $ex->getMessage();
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
	$result = $this->conn->prepare($sql);
	$result->execute();
	if ($nquery) {
	  $result = $result->rowCount();
	  
	}
	else {
	  $result = $result->fetchAll(PDO::FETCH_ASSOC);
	}
	return $result;
      } catch (Exception $ex) {
	echo 'Houve um erro ao conectar!' . $ex->getMessage();
      }
    }

    public function __destruct() {
      $this->conn = null;
    }

  }
  