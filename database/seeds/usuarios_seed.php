<?php

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

$mysqli->query("TRUNCATE TABLE usuarios");

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

$sql = "INSERT INTO usuarios (nome, email) VALUES
    ('Thomas Etges', 'thomas.etges.10@gmail.com')";

if ($mysqli->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso na tabela usuarios\n";
} else {
    echo "Erro ao inserir dados: " . $mysqli->error . "\n";
}
?>
