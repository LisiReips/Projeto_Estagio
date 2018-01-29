<?php

  $data = '16.06.1995';
  $hoje = date('d.m.Y h:i:s a', time());
  
  $bday = new DateTime($data);
  $today = new DateTime($hoje);
  $diff = $today->diff($bday);
  $temp = ':A anos, :M meses e :D dias';
  $idade = str_replace([':A',':M',':D'],[$diff->y, $diff->m, $diff->d],$temp);
  
  
  
  print_r($idade);