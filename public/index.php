<?php
include("../database/connection.php");
require_once __DIR__ . '/../app/Services/Router.php';

$router = new Router();

$router->get('/', function() {
    include("../app/Views/home.php");
});

$router->get('/home', function() {
    include("../app/Views/home.php");
});

$router->get('/eventos', 'EventosController@index');

$router->dispatch();
