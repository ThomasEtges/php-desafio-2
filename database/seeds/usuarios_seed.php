<?php

$sql = "INSERT INTO usuarios (nome, email) VALUES
    ('João Silva', 'joao@example.com'),
    ('Maria Oliveira', 'maria@example.com'),
    ('Pedro Santos', 'pedro@example.com'),
    ('Ana Costa', 'ana@example.com')";

if ($mysqli->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso na tabela usuarios\n";
} else {
    echo "Erro ao inserir dados: " . $mysqli->error . "\n";
}
?>
