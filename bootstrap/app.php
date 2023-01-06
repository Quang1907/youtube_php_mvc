<?php

$folder = str_replace( 'bootstrap', '', __DIR__ );
define( '__DIR_ROOT', str_replace( '\\', '/', $folder ) );

require_once __DIR_ROOT . 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable( __DIR_ROOT );
$dotenv->load();

use Core\App;
// use Core\Connection;
$app = new App;

// $conn = Connection::getInstance();

// $sql = "SELECT * FROM USERS";

// $stmt = $conn->query( $sql );
// $user = $stmt->fetchAll();

// echo '<pre>';
// var_dump( $user );
// echo '</pre>';