<?php 

require_once __DIR__ . "/../connection.php";

$sql = "CREATE TABLE IF NOT EXISTS tickets(

    id INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT,
    id_lote INT,
    id_usuario INT,
    horario_entrada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    horario_saida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ticket_status VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_evento) REFERENCES eventos(id),
    FOREIGN KEY (id_lote) REFERENCES lotes(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)

)";

if ($mysqli->query($sql)) {
    echo "\n-Tabela tickets criada com sucesso";
} else {
    echo "Erro: " . $mysqli->error;
};

?>