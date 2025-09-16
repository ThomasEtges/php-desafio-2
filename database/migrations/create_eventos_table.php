<?php 

require_once __DIR__ . "/../connection.php";

$sql = "CREATE TABLE IF NOT EXISTS eventos(

    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_fim TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    descricao VARCHAR(255) NOT NULL

)";

if ($mysqli->query($sql)) {
    echo "\n-Tabela eventos criada com sucesso";
} else {
    echo "Erro: " . $mysqli->error;
}

?>