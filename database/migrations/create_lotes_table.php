<?php 

require_once __DIR__ . "/../connection.php";

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

<<<<<<< HEAD
$mysqli->query("DROP TABLE lotes");
=======
$mysqli->query("DROP TABLE IF EXISTS lotes");
>>>>>>> 5eca5309c236c2a5b722fd5d8eebb41a66a53606

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

$sql = "CREATE TABLE IF NOT EXISTS lotes(

    id INT AUTO_INCREMENT PRIMARY KEY,
    fk_id_evento INT,
    ordem INT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
<<<<<<< HEAD
    qtd_maxima INT NOT NULL,
    qtd_vendida INT NOT NULL DEFAULT 0,
=======
    qtd_maxima INT,
    qtd_vendida INT DEFAULT 0,
>>>>>>> 5eca5309c236c2a5b722fd5d8eebb41a66a53606
    FOREIGN KEY (fk_id_evento) REFERENCES eventos(id)

)";

if ($mysqli->query($sql)) {
    echo "\n-Tabela lotes criada com sucesso";
} else {
    echo "Erro: " . $mysqli->error;
};

?>