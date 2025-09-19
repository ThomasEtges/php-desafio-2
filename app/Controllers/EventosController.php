<?php 

require_once __DIR__ . '/../Models/Evento.php';
require_once __DIR__ . '/../Models/Carrinho.php';

class EventosController
{

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function index()
    {
        $usuario_id = $_SESSION['usuario_id'] ?? 1;

        $eventoModel = new Evento($this->mysqli);
        $eventos = $eventoModel->listarTodos();

        $carrinhoModel = new Carrinho($this->mysqli);
        $carrinho = $carrinhoModel->mostrarCarrinho($usuario_id);

        require_once __DIR__ . '/../Views/eventos.php';
    }

}

?>