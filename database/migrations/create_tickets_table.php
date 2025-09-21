<?php 

require_once __DIR__ . "/../connection.php";

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

$mysqli->query("DROP TABLE IF EXISTS tickets");

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

$sql = "CREATE TABLE IF NOT EXISTS tickets(

    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(11) NOT NULL,
    fk_id_evento INT,
    fk_id_lote INT,
    fk_id_usuario INT,
    horario_entrada TIMESTAMP NULL DEFAULT NULL,
    horario_saida TIMESTAMP NULL DEFAULT NULL,
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_compra TIMESTAMP NULL DEFAULT NULL,
    status ENUM('pendente', 'cancelado', 'pago') NOT NULL DEFAULT 'pendente',
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