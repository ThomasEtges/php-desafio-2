<?php 

class Evento {

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function listarTodos()

    {
        $query = "
            SELECT
                e.id AS evento_id,
                e.nome,
                e.data_inicio,
                e.data_fim,
                e.descricao,
                l.ordem AS lote_atual,
                l.preco,
                l.id AS lote_id
            FROM eventos e
            LEFT JOIN lotes l ON e.id = l.fk_id_evento AND l.ordem = e.lote_atual
            ORDER BY e.data_inicio ASC
        ";

        $result = $this->mysqli->query($query);

        if (!$result) {
            return [];
        }

        $eventos = [];
        while ($row = $result->fetch_assoc()) {
            $eventos[] = $row;
        }
        
        return $eventos;
    }
    
}

?>