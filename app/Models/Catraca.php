<?php 

class Catraca {

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function verificarCodigo($codigo) {
        $stmt = $this->mysqli->prepare("SELECT id, horario_entrada, horario_saida FROM tickets WHERE codigo = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function registrarEntrada($codigo) {
        $stmt = $this->mysqli->prepare("UPDATE tickets SET horario_entrada = CURRENT_TIMESTAMP WHERE codigo = ? AND horario_entrada IS NULL");
        $stmt->bind_param("s", $codigo);
        $result = $stmt->execute();

        return $result;
    }

    public function registrarSaida($codigo) {
        $stmt = $this->mysqli->prepare("UPDATE tickets SET horario_saida = CURRENT_TIMESTAMP WHERE codigo = ? AND horario_entrada IS NOT NULL AND horario_saida IS NULL");
        $stmt->bind_param("s", $codigo);
        $result = $stmt->execute();

        return $result;
    }

    public function verificarHorarioEvento($codigo) {
        $stmt = $this->mysqli->prepare("
            SELECT e.data_inicio, e.data_fim
            FROM tickets t
            INNER JOIN eventos e ON t.fk_id_evento = e.id
            WHERE t.codigo = ?
        ");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return false;
        }

        $evento = $result->fetch_assoc();
        $agora = date('Y-m-d H:i:s');

        return ($agora >= $evento['data_inicio'] && $agora <= $evento['data_fim']);
    }

}