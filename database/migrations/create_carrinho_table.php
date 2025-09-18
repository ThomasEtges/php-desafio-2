<?php 

require_once __DIR__ . "/../connection.php";

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

$mysqli->query("DROP TABLE IF EXISTS carrinho");

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

$sql = "CREATE TABLE IF NOT EXISTS carrinho(

    id INT AUTO_INCREMENT PRIMARY KEY,
    fk_id_evento INT,
    fk_id_lote INT,
    fk_id_usuario INT,
    FOREIGN KEY (fk_id_evento) REFERENCES eventos(id),
    FOREIGN KEY (fk_id_lote) REFERENCES lotes(id),
    FOREIGN KEY (fk_id_usuario) REFERENCES usuarios(id)

)";

if ($mysqli->query($sql)) {
    echo "\n-Tabela carrinho criada com sucesso";
} else {
    echo "Erro: " . $mysqli->error;
}

?>