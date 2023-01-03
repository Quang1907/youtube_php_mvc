<?php

namespace Core;

class App {
    public function __construct() {
        $route = new Route();
        $route->loadRoute();
        $route->execute();
    }
}