<?php

session_start();

include("../database/connection.php");
require_once __DIR__ . '/../app/Router/Router.php';

$router = new Router();

$router->get('/', function() {
    include("../app/Views/home.php");
});

$router->get('/home', function() {
    include("../app/Views/home.php");
});

$router->get('/eventos', 'EventosController@index');
$router->post('/carrinho/adicionar_item_carrinho', 'CarrinhosController@adicionarCarrinho');
$router->post('/carrinho/remover_item_carrinho', 'CarrinhosController@removerItemCarrinho');
$router->post('/carrinho/limpar_carrinho', 'CarrinhosController@limparCarrinho');

$router->dispatch();