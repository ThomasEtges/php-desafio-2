<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
</head>
<body>
        <h1>Pagamento dos Tickets</h1>

        <?php if (isset($_SESSION['msg'])): ?>
            <div class="success-message">
                <?php echo $_SESSION['msg']; ?>
                <?php unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>

        <form action="">
            <button type="submit">Finalizar Pagamento</button>
        </form>
            

    </div>
</body>
</html>
