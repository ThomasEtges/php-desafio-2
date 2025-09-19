<?php 

require_once __DIR__ . '/../Models/Ticket.php';
require_once __DIR__ . '/../Models/Evento.php';

class CarrinhosController
{

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function adicionarCarrinho()
    {

        $eventoModel = new Evento($this->mysqli);
        $eventos = $eventoModel->listarTodos();

        $msg = 'Adicionado ao carrinho!';

        require_once __DIR__ . '/../Views/eventos.php';

    }

}
?>