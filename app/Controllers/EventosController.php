<?php 

require_once __DIR__ . '/../Models/Evento.php';

class EventosController
{

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function index()
    {
        $eventoModel = new Evento($this->mysqli);
        $eventos = $eventoModel->listarTodos();

        require_once __DIR__ . '/../Views/eventos.php';
    }

}

?>