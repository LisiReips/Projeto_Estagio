<?php

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = 'root';
const DB_NAME = 'db_pacientes';
const DB_PORT = 3306;

$url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/Projeto_Estagio/';
define('URL',     $url);
define('SCRIPTS', URL . 'webroot/scripts/');
define('CSS',     URL. 'webroot/css/');
define('IMG',     URL. 'webroot/img/');

require 'classes/MysqlConn.class.php';