<?php 

require_once __DIR__ . "/../connection.php";

$sql = "CREATE TABLE IF NOT EXISTS lotes(

    id INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    qtd_maxima INT,
    FOREIGN KEY (id_evento) REFERENCES eventos(id)

)";

if ($mysqli->query($sql)) {
    echo "\n-Tabela lotes criada com sucesso";
} else {
    echo "Erro: " . $mysqli->error;
};

?>