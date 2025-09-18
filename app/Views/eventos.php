<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<style>

*{
    padding: 0;
    margin: 0;
}
.conteudo{
    display: flex;
    justify-content: space-between;
}

.eventosSection{
    padding: 25px;
}

.carrinhoSection{
    padding: 25px;
    border-left: 1px solid #727272ff;
    width: 200px;
}

.tituloCarrinho{
    display: flex;
    justify-content: center ;
}

</style>
<body class="conteudo">
    <div class="eventosSection">
    <main>
    <?php if ($eventos): ?>
        <ul>
            <?php foreach ($eventos as $evento): ?>
                <li>
                    <strong><?= htmlspecialchars($evento['nome']) ?></strong><br>
                    Início: <?= date('d/m/Y H:i', strtotime($evento['data_inicio'])) ?><br>
                    Fim: <?= date('d/m/Y H:i', strtotime($evento['data_fim'])) ?><br>
                    Descrição: <?= htmlspecialchars($evento['descricao']) ?><br>
                    Lote: <?= htmlspecialchars($evento['lote_atual']) ?><br>
                    Preço: <?= htmlspecialchars($evento['preco']) ?>
                </li>
                <input type="number" min="1" step="1" value="1"><button onclick="">Adicionar ao carrinho</button>
                <hr>
                <br>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum evento encontrado.</p>
    <?php endif; ?>
    <main>
    </div>
    <div class="carrinhoSection">
        <div class="tituloCarrinho">
            Carrinho
        </div>
    </div>
</body>
</html>