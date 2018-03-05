<?php

  $email = new Email();
  ini_set('default_charset', 'UTF-8');
  $email->Subject = "ASSUNTO";
  
  $email->setConteudoMSG('CONTEUDO');
  
  $email->add_email('EMAIL','PESSOA');
  $email->enviar();
  
  $email->clearEmail();//limpa os destinatarios