<?php

$mysqli->query("SET FOREIGN_KEY_CHECKS = 0");

$mysqli->query("TRUNCATE TABLE eventos");

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1");

$sql = "INSERT INTO eventos (nome, data_inicio, data_fim, descricao) VALUES
    ('União Corinthians X Bauru', '2025-10-01 17:00:00', '2025-10-01 19:00:00', 'Jogo do time X contra time Y'),
    ('Pato Basquete X Minas', '2025-09-15 17:30:00', '2025-09-15 19:30:00', 'Jogo do time X contra time Y'),
    ('Vasco X Flamengo', '2025-11-20 17:00:00', '2025-11-20 19:00:00', 'Jogo do time X contra time Y'),
    ('Franca X São José', '2025-11-25 18:00:00', '2025-11-25 20:00:00', 'Jogo do time X contra time Y')";

if ($mysqli->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso na tabela eventos\n";
} else {
    echo "Erro ao inserir dados: " . $mysqli->error . "\n";
}

?>