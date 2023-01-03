<?php

use App\ProductController;
use App\UserController;
use Core\Route;

// Route::get( $path, $callback );

Route::get( "quang", function () {
    echo 'quang';
});
Route::get( "users/{id}/{name}", [ UserController::class, 'index' ] )->where( [ 'id' => '[0-9]+', 'name' => '[a-z]+']);
Route::get( "product", [ ProductController::class, 'index' ] );

// Route::get( "users/{id}", [ UserController::class, 'index' ] )->where( [ 'id' => '[0-9]+' ] );
// Route::post( 'product', [ ProductController::class, 'index' ] );