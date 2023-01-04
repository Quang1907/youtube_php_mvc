<?php
namespace Core;

use Exception;
use PDO;

class Connection {
    private static $instance;
    // private $host = 'localhost';
    // private $dbName = 'youtube';
    // private $userName = 'root';
    // private $password = '';

    private function __construct() {
        try {
            $dsn = 'mysql:host=' . $_ENV[ 'DB_HOST' ] . ';dbname=' . $_ENV[ 'DB_NAME' ];
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
            return self::$instance = new PDO( $dsn, $_ENV[ 'DB_USERNAME' ], $_ENV[ 'DB_PASSWORD' ], $options );
        } catch ( Exception $ex ) {
            Error::render( [ 'mesaage' => $ex ] );
        }
    }
    public static function getInstance() {
        if ( empty( self::$instance ) ) {
            new Connection;
        }
        return self::$instance;
    }
}