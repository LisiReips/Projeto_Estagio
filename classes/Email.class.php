<?php

require('phpmailer/PHPMailerAutoload.php');

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

  public function add_email($email, $nome = "") {
    $idx = count($this->lista);
    $this->lista[$idx] = array("email" => $email, "nome" => $nome);
  }

  /*
   * Carrega as configurações padrões
   */

  private function carregar_default() {
    $this->SMTPKeepAlive = true;
    $this->CharSet = 'utf-8';
    $this->IsSMTP(); // enable SMTP
    $this->SMTPDebug = 0;

    $this->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $this->Host = 'smtp.gmail.com';
    $this->Port = '587';
    $this->SMTPSecure = 'tls';
    $this->SMTPAuth = true;
    $this->Username = 'lisireips@gmail.com';
    $this->Password = 'eumesmalili';

    $this->setFrom('ciemp@ciemp.com', 'Viviane');
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
      } else {
        break;
      }
      $this->clearAddresses();
    }
  }

  public function clearEmail() {
    $this->lista = array();
  }

}
