<?php 

require_once __DIR__ . '/../Models/Catraca.php';
require_once __DIR__ . '/../Models/Carrinho.php';

class CatracaController
{

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function index(){
        
        require_once __DIR__ . '/../Views/catraca.php';

    }

    public function verificarCodigo()
    {

        $codigo = trim($_POST['codigo']);
        $tipo = $_POST['tipo'];

        $catracaModel = new Catraca($this->mysqli);

        $result = $catracaModel->verificarCodigo($codigo);

        if ($result->num_rows === 0) {
            $_SESSION['msg'] = "Código não encontrado!";
            header('Location: /catraca');
            return;
        }

        $ticket = $result->fetch_assoc();

        $horarioValido = $catracaModel->verificarHorarioEvento($codigo);

        if (!$horarioValido) {
            $_SESSION['msg'] = "Acesso negado! Acesso fora de horário";
            header('Location: /catraca');
            return;
        }

        if ($tipo === 'entrada') {
            if ($ticket['horario_entrada'] !== null) {
                $_SESSION['msg'] = "Este código já possui registro de entrada!";
                header('Location: /catraca');
                return;
            }

            $resultado = $catracaModel->registrarEntrada($codigo);

            if ($resultado) {
                $_SESSION['msg'] = "Entrada registrada com sucesso!";
            } else {
                $_SESSION['msg'] = "Erro ao registrar entrada. Tente novamente.";
            }

        } elseif ($tipo === 'saida') {
            if ($ticket['horario_entrada'] === null) {
                $_SESSION['msg'] = "Não é possível registrar saída sem registro de entrada!";
                header('Location: /catraca');
                return;
            }

            if ($ticket['horario_saida'] !== null) {
                $_SESSION['msg'] = "Este código já possui registro de saída!";
                header('Location: /catraca');
                return;
            }

            $resultado = $catracaModel->registrarSaida($codigo);

            if ($resultado) {
                $_SESSION['msg'] = "Saída registrada com sucesso!";
            } else {
                $_SESSION['msg'] = "Erro ao registrar saída. Tente novamente.";
            }
        }

        header('Location: /catraca');
    }
    

}