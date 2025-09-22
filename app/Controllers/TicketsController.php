<?php 

require_once __DIR__ . '/../Models/Ticket.php';
require_once __DIR__ . '/../Models/Evento.php';
require_once __DIR__ . '/../Models/Carrinho.php';

class TicketsController
{

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;

    }

    public function adicionarTicket()
    {
        $usuario_id = $_SESSION['usuario_id'] ?? 1;

        $carrinhoModel = new Carrinho($this->mysqli);
        $carrinho_items = $carrinhoModel->mostrarCarrinho($usuario_id);

        $ticketModel = new Ticket($this->mysqli);
        $ticket = $ticketModel->adicionarTicket($carrinho_items);

        if ($ticket) {
        $carrinhoModel->limparCarrinho($usuario_id);
        $_SESSION['msg'] = "Tickets comprados com sucesso! Faça o pagamento";
        header('Location: /pagamento');
        exit();
        } else {
        $_SESSION['msg'] = "Erro ao processar a compra. Verifique se os tickets ainda estão disponiveis para esse lote.";
        header('Location: /compra');
        exit();
    }
    }

    public function pagamento()
    {

        $ticketModel = new Ticket($this->mysqli);
        $ticket = $ticketModel->pagamento();

    }

    public function pagarTicket()
    {

        $ticketModel = new Ticket($this->mysqli);
        $ticket = $ticketModel->pagarTicket();

        $_SESSION['msg'] = "Pagamento realizado com sucesso!";
        header('Location: /eventos');
        exit();

    }

}
?>