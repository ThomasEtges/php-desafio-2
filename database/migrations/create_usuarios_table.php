<?php 

require_once __DIR__ . "/../connection.php";

$sql = "CREATE TABLE IF NOT EXISTS usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL
)";

if ($mysqli->query($sql)) {
    echo "\n-Tabela usuarios criada com sucesso";
} else {
    echo "Erro: " . $mysqli->error;
};

?>