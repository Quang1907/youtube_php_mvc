<?php

$folder = str_replace( 'bootstrap', '', __DIR__ );
define( '__DIR_ROOT', str_replace( '\\', '/', $folder ) );

require_once __DIR_ROOT . 'vendor/autoload.php';

use Core\App;

$app = new App;
