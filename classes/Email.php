<?php

  require 'phpmailer/PHPMailerAutoload.php';

  class Email extends PHPMailer {

    private $lista = array();
    private $conteudo = "";

    public function __construct($carregar_default = true, $exceptions = true) {

      if ($carregar_default) {
	$this->carregar_default();
      }

      if ($exceptions !== null) {
	$this->exceptions = (boolean) $exceptions;
      }
    }

    /*
     * Carrega as configurações padrões
     */

    private function carregar_default() {
      $this->SMTPKeepAlive = true;
      $this->CharSet = 'utf-8';
      $this->isSMTP();
      $this->SMTPDebug = 0;

      $this->Host = 'PROVEDOR';
      $this->Port = 'PORTA';
      $this->SMTPSecure = 'none';
      $this->SMTPAuth = true;
      $this->Username = 'EMAIL';
      $this->Password = 'SENHA';

      $this->setFrom('EMAIL DO REMETENTE', 'NOME  DO REMETENTE');
    }

    /*
     * Função de envio
     */

    public function enviar() {

      foreach ($this->lista as $row) {
	if ($row != NULL) {

	  $this->addAddress($row["email"], $row["nome"]);
	  if (!$this->send()) {
	    echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $this->ErrorInfo . '<br />';
	    break; //Abandon sending
	  }
	}
	else {
	  break;
	}
	$this->clearAddresses();
      }
    }

    public function clearEmail() {
      $this->lista = array();
    }

  }
  