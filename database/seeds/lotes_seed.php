<?php

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

$mysqli->query("TRUNCATE TABLE lotes");

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

$sql = "INSERT INTO lotes (fk_id_evento, ordem, preco, qtd_maxima) VALUES
    ('1', '1', '30.00', '1'),
    ('1', '2', '45.00', '1'),
    ('2', '1', '25.00', '2'),
    ('2', '2', '30.00', '2'),
    ('2', '3', '35.00', '2'),
    ('3', '1', '35.00', '3'),
    ('3', '2', '45.00', '3'),
    ('4', '1', '25.00', '4'),
    ('4', '2', '30.00', '4')";

if ($mysqli->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso na tabela lotes\n";
} else {
    echo "Erro ao inserir dados: " . $mysqli->error . "\n";
}

?>