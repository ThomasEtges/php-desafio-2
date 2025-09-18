<?php 

require_once __DIR__ . "/../connection.php";

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

<<<<<<< HEAD
$mysqli->query("DROP TABLE eventos");
=======
$mysqli->query("DROP TABLE IF EXISTS eventos");
>>>>>>> 5eca5309c236c2a5b722fd5d8eebb41a66a53606

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

$sql = "CREATE TABLE IF NOT EXISTS eventos(

    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_fim TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    descricao VARCHAR(255) NOT NULL,
<<<<<<< HEAD
    qtd_lotes INT NOT NULL,
    lote_atual INT DEFAULT 1,
    total_ingressos INT NOT NULL,
    qtd_vendida INT NOT NULL
=======
    qtd_lotes INT,
    lote_atual INT DEFAULT 1,
    qtd_tickets INT,
    tickets_vendidos INT DEFAULT 0
>>>>>>> 5eca5309c236c2a5b722fd5d8eebb41a66a53606

)";

if ($mysqli->query($sql)) {
    echo "\n-Tabela eventos criada com sucesso";
} else {
    echo "Erro: " . $mysqli->error;
}

?>