<?php 

require_once __DIR__ . "/../connection.php";

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

<<<<<<< HEAD
$mysqli->query("DROP TABLE usuarios");
=======
$mysqli->query("DROP TABLE IF EXISTS usuarios");
>>>>>>> 5eca5309c236c2a5b722fd5d8eebb41a66a53606

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

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