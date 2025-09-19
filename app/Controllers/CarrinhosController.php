<?php 

require_once __DIR__ . '/../Models/Evento.php';
require_once __DIR__ . '/../Models/Carrinho.php';

class CarrinhosController
{

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function adicionarCarrinho()
    {
        $qtd_tickets = $_POST['qtd_tickets'];
        $evento_id = $_POST['evento_id'];
        $lote_id = $_POST['lote_id'];
        $usuario_id = $_SESSION['usuario_id'] ?? 1;

        $carrinhoModel = new Carrinho($this->mysqli);
        $carrinho = $carrinhoModel->adicionarCarrinho($qtd_tickets, $evento_id, $lote_id, $usuario_id);

        $_SESSION['msg'] = 'Adicionado ao carrinho!';

        header('Location: /eventos');

        exit;
    }

    public function removerItemCarrinho()
    {

        $item_carrinho = $_POST['item_carrinho'];
        $usuario_id = $_SESSION['usuario_id'] ?? 1;

        $carrinhoModel = new Carrinho($this->mysqli);
        $carrinho = $carrinhoModel->deletarItemCarrinho($item_carrinho, $usuario_id);

        $_SESSION['msg'] = 'Item removido do carrinho!';

        header('Location: /eventos');
        exit;
    }

    public function limparCarrinho()
    {

        $usuario_id = $_SESSION['usuario_id'] ?? 1;

        $carrinhoModel = new Carrinho($this->mysqli);
        $carrinhoModel->limparCarrinho($usuario_id);

        $_SESSION['msg'] = 'Carrinho limpo!';

        header('Location: /eventos');
        exit;
    }

    

}
?>