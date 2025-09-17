<?php

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

$mysqli->query("TRUNCATE TABLE lotes");

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

$sql = "INSERT INTO lotes (id_evento, nome, preco, qtd_maxima) VALUES
    ('1', 'Lote 1', '30.00', '2000'),
    ('1', 'Lote 2', '45.00', '2000'),
    ('2', 'Lote 1', '25.00', '1000'),
    ('2', 'Lote 2', '30.00', '1500'),
    ('2', 'Lote 3', '35.00', '1500'),
    ('3', 'Lote 1', '35.00', '1750'),
    ('3', 'Lote 2', '45.00', '1750'),
    ('4', 'Lote 1', '25.00', '1000'),
    ('4', 'Lote 2', '30.00', '1000')";

if ($mysqli->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso na tabela lotes\n";
} else {
    echo "Erro ao inserir dados: " . $mysqli->error . "\n";
}

?>