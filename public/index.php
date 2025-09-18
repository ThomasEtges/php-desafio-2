<?php
include("../database/connection.php");
require_once __DIR__ . '/../app/Controllers/EventosController.php';

$page = isset($_GET['page']) ? $_GET['page'] : '';

switch ($page) {
    case 'home':
        include("../app/Views/home.php");
        break;
    case 'eventos':
        $eventoController = new EventosController($mysqli);
        $eventoController->index();
        break;
    default:
        echo "Página não encontrada!";
        break;
}
