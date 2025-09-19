<?php 

require_once __DIR__ . "/../connection.php";

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

$mysqli->query("DROP TABLE IF EXISTS tickets");

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

$sql = "CREATE TABLE IF NOT EXISTS tickets(

    id INT AUTO_INCREMENT PRIMARY KEY,
    fk_id_evento INT,
    fk_id_lote INT,
    fk_id_usuario INT,
    horario_entrada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    horario_saida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ticket_status VARCHAR(255) NOT NULL,
    FOREIGN KEY (fk_id_evento) REFERENCES eventos(id),
    FOREIGN KEY (fk_id_lote) REFERENCES lotes(id),
    FOREIGN KEY (fk_id_usuario) REFERENCES usuarios(id)

)";

if ($mysqli->query($sql)) {
    echo "\n-Tabela tickets criada com sucesso";
} else {
    echo "Erro: " . $mysqli->error;
};

?>