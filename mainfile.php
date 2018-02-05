<?php

const DB_HOST = 'localhost';
const DB_USER = 'postgres';
const DB_PASS = 'raven';
const DB_NAME = 'teste';
const DB_PORT = 5432;

$url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/Projeto_Estagio/';
define('URL',     $url);
define('SCRIPTS', URL . 'webroot/scripts/');
define('CSS',     URL. 'webroot/css/');
define('IMG',     URL. 'webroot/img/');

require 'classes/PgConn.class.php';