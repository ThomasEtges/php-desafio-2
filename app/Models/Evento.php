<?php 

class Evento {

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function listarTodos()
{
    $sql = "
        SELECT 
    e.id AS evento_id,
    e.nome AS evento_nome,
    e.data_inicio,
    e.data_fim,
    e.descricao,
    l.id AS lote_id,
    l.nome AS lote_nome,    
    l.preco,
    l.qtd_maxima,
    COUNT(t.id) AS tickets_vendidos,
    CASE 
        WHEN COUNT(t.id) >= l.qtd_maxima THEN 1
        ELSE 0
    END AS lote_cheio
FROM eventos e
LEFT JOIN lotes l ON l.id_evento = e.id
LEFT JOIN tickets t ON t.id_lote = l.id
GROUP BY e.id, l.id
HAVING COUNT(t.id) < l.qtd_maxima
ORDER BY e.data_inicio ASC, l.id ASC;
    ";

    $result = $this->mysqli->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}


}

?>