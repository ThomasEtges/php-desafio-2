<?php
include("../database/connection.php");

$page = isset($_GET['page']) ? $_GET['page'] : '';

switch ($page) {
    case 'home':
        include("../app/Views/home.php");
        break;
    case 'eventos':
        include("../app/Views/eventos.php");
        break;
    default:
        echo "Página não encontrada!";
        break;
}
