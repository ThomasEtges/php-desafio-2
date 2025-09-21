<?php 

class Compra {

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function adicionarDesconto($input_desconto) {
        
        $stmt = $this->mysqli->prepare("SELECT porcentagem, maximo_desconto FROM descontos WHERE codigo = ?");
        $stmt->bind_param("s", $input_desconto);
        $stmt->execute();
        $desconto = $stmt->get_result();

        return $desconto;

    }

}