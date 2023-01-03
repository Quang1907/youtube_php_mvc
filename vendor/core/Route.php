<?php

namespace Core;

class Route {
    static private $path;
    static private $routeConfig;
    static private $route;
    static private $routeWhere;

    public function __construct() {
        self::$route = $this;
    }

    public function loadRoute() {
        $pathRoute = __DIR_ROOT . 'routes/web.php';
        if ( file_exists( $pathRoute ) ) {
            return require_once $pathRoute;
        }
        Error::render( [ "message" => "khong tim thay route" ] );
    }

    public static function get( $path, $callback ) {
        self::$path = $path;
        self::$routeConfig[ 'get' ][ $path ] = $callback;
        return self::$route;
    } 

    public static function where( $where = [] ) {
        self::$routeWhere[ self::$path ] = $where;
    }

    public static function post( $path, $callback ) {
        self::$path = $path;
        self::$routeConfig[ 'post' ][ $path ] = $callback;
        return self::$route;
    }

    public function execute() {
        $check = $this->getParams( $params, $callback );

        if ( $check ) {
            if ( is_object( $callback ) ) {
                return call_user_func( $callback );
            } elseif ( is_array( $callback ) ) {
                if ( class_exists( $callback[ 0 ] ) ) {
                    $controller = new $callback[ 0 ]; 
                    $callback = [ $controller, $callback[ 1 ] ];
                    if ( method_exists( $controller, $callback[ 1 ] ) ) {
                        return call_user_func_array( $callback, $params );
                    } else {
                        Error::render( [ "message" => "Function không tồn tại" ] );
                    }
                } else {
                    Error::render( [ "message" => "Class không tồn tại"] );
                }
            }
        }

        Error::render( [ "message" => "Đường dẫn không tồn tại" ] );
    }

    public function getParams( &$params, &$callback ) {
        $check = false;
        $currentPath = $this->getPath();
        $method = $this->getMethod();

        if ( !empty( self::$routeConfig[ $method ] ) ) {
            foreach ( self::$routeConfig[ $method ] as $path => $callback ) {
                $pattern = "~^$path$~";
                if ( !empty( self::$routeWhere[ $path ] ) ) {
                    foreach ( self::$routeWhere[ $path ] as $paramsName => $pathPattern ) {
                        $pattern = str_replace( '{'. $paramsName .'}', '(' . $pathPattern. ')', $pattern );
                    }
                } else {
                    $pattern = preg_replace( "~{.+?}~", "(.+?)", $pattern );
                }

                preg_match( $pattern, $currentPath, $matches );

                if ( !empty( $matches ) ) {
                    unset( $matches[0] );
                    $params = array_values( $matches );
                    $check = true;
                    break;
                }
            }
        }
        return $check;
    }

    public function getPath() {
        return trim( !empty( $_SERVER[ 'PATH_INFO' ] ) ? $_SERVER[ 'PATH_INFO' ] : ''  , '/' );
    }

    public function getMethod() {
        return strtolower( $_SERVER[ 'REQUEST_METHOD' ] );
    }
}