<?php

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = 315218;
const DB_NAME = 'db_pacientes';
const DB_PORT = 5432;

$url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/Projeto_Estagio/';
define('URL',     $url);
define('SCRIPTS', URL . 'webroot/scripts/');
define('CSS',     URL. 'webroot/css/');
define('IMG',     URL. 'webroot/img/');

require 'classes/PgConn.class.php';
require 'classes/Email.class.php';
require 'menus.php';