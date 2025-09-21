<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (isset($_SESSION['msg'])): ?>
            <div class="success-message">
                <?php echo $_SESSION['msg']; ?>
                <?php unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>
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
        <?php if ($desconto): ?>
            <p>Desconto aplicado: <?= htmlspecialchars($desconto['porcentagem']) ?>%</p>
        <?php else: ?>
            <p>Nenhum desconto.</p>
        <?php endif; ?>
        <?php
        $total = 0;
        foreach ($carrinho as $item_carrinho) {
            $total += $item_carrinho['preco'] * $item_carrinho['qtd_tickets'] ;
        }
        if ($desconto) {
            $desconto_valor = $total * ($desconto['porcentagem'] / 100);
            if ($desconto_valor > $desconto['maximo_desconto']) {
                $desconto_valor = $desconto['maximo_desconto'];
            }
            $total -= $desconto_valor;
        }
        ?>
        <p><strong>Total: R$ <?= number_format($total, 2, ',', '.') ?></strong></p>

        <form action="/compra/adicionar_desconto" method="POST">
            <input type="text" name="input_desconto">
            <button type="submit">Adicionar desconto</button>
        </form>

        <form action="/carrinho/limpar_carrinho" method="POST">
                <button type="submit">Limpar carrinho</button>
        </form>
        <form action="/compra/criar_ticket" method="GET">
                <button type="submit">Ir para pagamento</button>
        </form>
             <?php else: ?>
        <p>Nenhum item no carrinho.</p>
    <?php endif; ?>
</body>
</html>