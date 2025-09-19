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

    <?php if (isset($_SESSION['msg'])): ?>
        <h1><?= htmlspecialchars($_SESSION['msg']) ?></h1>
        <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>

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
        <form action="/carrinho/adicionar_item_carrinho" method="POST">
            <input type="number" name="qtd_tickets" min="1" step="1" value="1" required>
            <input type="hidden" name="evento_id" value="<?= htmlspecialchars($evento['evento_id']) ?>">
            <input type="hidden" name="lote_id" value="<?= htmlspecialchars($evento['lote_id']) ?>">
            <button type="submit">Adicionar ao carrinho</button>
        </form>
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
        <?php if ($carrinho): ?>
        <ul>
            <?php foreach ($carrinho as $item_carrinho): ?>
                <li>
                <strong><?= htmlspecialchars($item_carrinho['nome_evento']) ?></strong><br>
                Lote: <?= htmlspecialchars($item_carrinho['lote']) ?><br>
                Preço: <?= htmlspecialchars($item_carrinho['preco']) ?><br>
                Quantidade tickets: <?= htmlspecialchars($item_carrinho['qtd_tickets']) ?><br>
                <form action="/carrinho/remover_item_carrinho" method="POST">
                <input type="hidden" name="item_carrinho" value="<?= htmlspecialchars($item_carrinho['item_carrinho_id']) ?>">
                <button type="submit">Remover ticket</button>
                </form>
                </li>
                <br>
            <?php endforeach; ?>
        </ul>

        <form action="/carrinho/limpar_carrinho" method="POST">
                <button type="submit">Limpar carrinho</button>
                </form>
    <?php else: ?>
        <p>Nenhum item no carrinho.</p>
    <?php endif; ?>
    </div>
</body>
</html>