<?php

namespace Core;

class Error {
    public static function render( $data = [], $name = '404' ) {
        extract( $data );
        $pathErorr = __DIR_ROOT . 'resources/views/errors/'. $name . '.blade.php';
        if ( file_exists( $pathErorr ) ) {
            require_once $pathErorr;
        } 
        die;
    }
}