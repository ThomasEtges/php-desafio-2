<?php
require_once "connection.php";

include "migrations/create_usuarios_table.php";
include "migrations/create_eventos_table.php";
include "migrations/create_lotes_table.php";
include "migrations/create_tickets_table.php";

echo "\n-Migrations executadas\n";
?>