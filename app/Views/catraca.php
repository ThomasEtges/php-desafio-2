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
    <h1>CATRACA</h1>
    <form action="catraca/verificar_codigo" method="POST">
        <label>DIGITE O CÓDIGO PARA ACESSAR O EVENTO</label><br>
        <input type="text" name="codigo" required><br><br>

        <label>Entrada</label>
        <input type="radio" value="entrada" name="tipo"><br>

        <label>Saída</label>
        <input type="radio" value="saida" name="tipo"><br><br>

        <button type="submit">ACESSAR</button>
    </form>

</body>
</html>