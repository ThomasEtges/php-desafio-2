<?php 

require_once __DIR__ . "/../connection.php";

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

$mysqli->query("DROP TABLE IF EXISTS descontos");

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

$sql = "CREATE TABLE IF NOT EXISTS descontos(

    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(100) NOT NULL,
    porcentagem INT,
    maximo_desconto DECIMAL(10,2) NOT NULL

)";

if ($mysqli->query($sql)) {
    echo "\n-Tabela descontos criada com sucesso";
} else {
    echo "Erro: " . $mysqli->error;
}

?>