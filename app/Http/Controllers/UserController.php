<?php

namespace App\Http\Controllers;

class UserController {
    public function index( $id, $name ) {
        echo $id;
        echo "<br>";
        echo $name;
    }
}