<?php

class Ticket
{

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function adicionarTicket($carrinho_items)
    {
        $usuario_id = $_SESSION['usuario_id'] ?? 1;
        $status = 'pendente';

        foreach ($carrinho_items as $item) {
            $evento_id = $item['fk_id_evento'];
            $lote_id = $item['fk_id_lote'];
            $qtd_tickets = $item['qtd_tickets'];

            $lote_stmt = $this->mysqli->prepare("SELECT qtd_maxima, qtd_vendida FROM lotes WHERE id = ?");
            $lote_stmt->bind_param("i", $lote_id);
            $lote_stmt->execute();
            $lote_stmt->bind_result($qtd_maxima_lote, $qtd_vendida_lote);
            $lote_stmt->fetch();
            $lote_stmt->close();

            if (($qtd_vendida_lote + $qtd_tickets) > $qtd_maxima_lote) {
                return false;
            }

            $stmt = $this->mysqli->prepare("
                INSERT INTO tickets (fk_id_evento, fk_id_lote, fk_id_usuario, status)
                VALUES (?, ?, ?, ?)
            ");

            for ($i = 0; $i < $qtd_tickets; $i++) {
                $stmt->bind_param("iiis", $evento_id, $lote_id, $usuario_id, $status);
                $stmt->execute();
            }

            $stmt->close();

            $update_stmt = $this->mysqli->prepare("UPDATE lotes SET qtd_vendida = qtd_vendida + ? WHERE id = ?");
            $update_stmt->bind_param("ii", $qtd_tickets, $lote_id);
            $update_stmt->execute();
            $update_stmt->close();

            $lote_stmt = $this->mysqli->prepare("SELECT qtd_vendida FROM lotes WHERE id = ?");
            $lote_stmt->bind_param("i", $lote_id);
            $lote_stmt->execute();
            $lote_stmt->bind_result($qtd_vendida_lote_updated);
            $lote_stmt->fetch();
            $lote_stmt->close();
            
            $evento_stmt = $this->mysqli->prepare("SELECT qtd_lotes, lote_atual FROM eventos WHERE id = ?");
            $evento_stmt->bind_param("i", $evento_id);
            $evento_stmt->execute();
            $evento_stmt->bind_result($qtd_lotes, $lote_atual);
            $evento_stmt->fetch();
            $evento_stmt->close();
            
            if (($qtd_lotes > $lote_atual) && ($qtd_vendida_lote_updated == $qtd_maxima_lote)) {
                $update_lote_atual_stmt = $this->mysqli->prepare("UPDATE eventos SET lote_atual = lote_atual + 1 WHERE id = ?");
                $update_lote_atual_stmt->bind_param("i", $evento_id);
                $update_lote_atual_stmt->execute();
                $update_lote_atual_stmt->close();
            }

        }

        return true;
    }

    public function pagamento() {

        require_once __DIR__ . '/../Views/pagamento.php';
        
    }

    public function pagarTicket(){
        $usuario_id = $_SESSION['usuario_id'] ?? 1;

        $stmt = $this->mysqli->prepare("
            SELECT id FROM tickets
            WHERE fk_id_usuario = ? AND status = 'pendente'
        ");
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $codigo = $this->gerarCodigo();

        $update_stmt = $this->mysqli->prepare("
            UPDATE tickets
            SET status = 'pago', codigo = ?, data_compra = CURRENT_TIMESTAMP
            WHERE fk_id_usuario = ? AND status = 'pendente'
        ");
        $update_stmt->bind_param("si", $codigo, $usuario_id);
        $update_result = $update_stmt->execute();

        $stmt->close();
        $update_stmt->close();

    }

    private function gerarCodigo(){
        $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';

        for ($i = 0; $i < 11; $i++) {
            if ($i == 3 || $i == 7) {
                $codigo .= '-';
            } else {
                $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
            }
        }

        return $codigo;
    }
}
