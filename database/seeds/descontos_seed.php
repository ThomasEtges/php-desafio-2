<?php

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

$mysqli->query("TRUNCATE TABLE descontos");

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

$sql = "INSERT INTO descontos(codigo, porcentagem, maximo_desconto) VALUES
    ('SEXTOU10', '10', '10'),
    ('QUINZOU932', '15', '20')";

if ($mysqli->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso na tabela descontos\n";
} else {
    echo "Erro ao inserir dados: " . $mysqli->error . "\n";
}

?>