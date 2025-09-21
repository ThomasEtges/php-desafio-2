<?php

class Carrinho
{

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function mostrarCarrinho($usuario_id)
    {

        $query = "
            SELECT
                c.fk_id_evento,
                c.fk_id_lote,
                e.nome AS nome_evento,
                l.ordem AS lote,
                l.preco,
                c.qtd_tickets,
                c.id AS item_carrinho_id
            FROM carrinho c
            JOIN eventos e ON c.fk_id_evento = e.id
            JOIN lotes l ON c.fk_id_lote = l.id
            WHERE c.fk_id_usuario = ?
            ORDER BY e.data_inicio ASC
        ";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $carrinho = [];
        while ($row = $result->fetch_assoc()) {
            $carrinho[] = $row;
        }

        $stmt->close();
        return $carrinho;
    }

    public function adicionarCarrinho($qtd_tickets, $evento_id, $lote_id, $usuario_id)
    {
        $stmt = $this->mysqli->prepare("
        INSERT INTO carrinho (fk_id_evento, fk_id_lote, fk_id_usuario, qtd_tickets)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE qtd_tickets = qtd_tickets + VALUES(qtd_tickets)
    ");

        $stmt->bind_param("iiii", $evento_id, $lote_id, $usuario_id, $qtd_tickets);
        $stmt->execute();
        $stmt->close();
    }

    public function deletarItemCarrinho($item_carrinho, $usuario_id)
    {
        $stmt = $this->mysqli->prepare("
        DELETE FROM carrinho
        WHERE id = ? AND fk_id_usuario = ?
    ");

        $stmt->bind_param("ii", $item_carrinho, $usuario_id);
        $stmt->execute();
        $stmt->close();
    }

    public function limparCarrinho($usuario_id)
    {
        $stmt = $this->mysqli->prepare("
        DELETE FROM carrinho
        WHERE fk_id_usuario = ?
    ");

        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $stmt->close();
    }
}
