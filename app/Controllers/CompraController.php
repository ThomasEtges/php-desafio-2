<?php

require_once __DIR__ . '/../Models/Carrinho.php';
require_once __DIR__ . '/../Models/Compra.php';

class CompraController
{

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function index()
    {
        $usuario_id = $_SESSION['usuario_id'] ?? 1;

        $carrinhoModel = new Carrinho($this->mysqli);
        $carrinho = $carrinhoModel->mostrarCarrinho($usuario_id);

        $desconto = null;

        require_once __DIR__ . '/../Views/compra.php';
    }

    public function adicionarDesconto(){

        $usuario_id = $_SESSION['usuario_id'] ?? 1;

        $input_desconto = $_POST['input_desconto'];

        $compraModel = new Compra($this->mysqli);
        $desconto_result = $compraModel->adicionarDesconto($input_desconto);

        $desconto = $desconto_result->fetch_assoc();

        $carrinhoModel = new Carrinho($this->mysqli);
        $carrinho = $carrinhoModel->mostrarCarrinho($usuario_id);

        require_once __DIR__ . '/../Views/compra.php';
    }

}
?>
