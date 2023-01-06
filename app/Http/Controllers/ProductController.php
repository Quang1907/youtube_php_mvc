<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProductController {
    public function index() {
        $data = [];
        User::insert( $data );
    }
}